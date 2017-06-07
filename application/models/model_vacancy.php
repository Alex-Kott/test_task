<?php

class Model_Vacancy extends Model
{
	public function __construct(){
		$this->dbh = new PDO("pgsql:dbname=test_task;host=localhost;user=test_user;password=qwerty"); 
	}

	public function add($form){

		$sql = "INSERT INTO vacancy(title, description, responsibilities, demands, salary, active) VALUES (:title, :description, :responsibilities, :demands, :salary, :active)";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(":title", $form['title']);
		$stmt->bindParam(":description", $form['description']);
		$stmt->bindParam(":responsibilities", $form['responsibilities']);
		$stmt->bindParam(":demands", $form['demands']);
		$stmt->bindParam(":salary", $form['salary'], PDO::PARAM_INT);
		$stmt->bindParam(":active", $form['active'], PDO::PARAM_BOOL);
		$stmt->execute();
	}

	public function get_vacancies(){
		$sql = "SELECT * FROM vacancy";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute();
		return $stmt->fetchALL(PDO::FETCH_UNIQUE);
	}

	public function get_vacancies_for_cand($candId){
		$sql = "SELECT v.id, v.title FROM candvac AS cv
					JOIN candidate AS c
						ON cv.candid = c.id
					JOIN vacancy AS v
						ON cv.vacid = v.id
					WHERE c.id = :id;";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(":id", $candId, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchALL(PDO::FETCH_KEY_PAIR);
	}

	public function get_candidates_for_vacancy($vacId){
		$sql = "SELECT c.id, c.name, c.surname, c.status, c.lastdate FROM candvac AS cv
					JOIN candidate AS c
						ON cv.candid = c.id
					JOIN vacancy AS v
						ON cv.vacid = v.id
					WHERE v.id = :id;";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(":id", $vacId, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchALL(PDO::FETCH_UNIQUE);
	}

	public function linkVacanciesToCandidate($candId, $vacancies){ // для связи кандидат -> вакансия (1:n) будем 	
																//использовать таблицу с составными ключами (id кандидата и вакансии). потом просто сджойним.
		$sql = "DELETE FROM candvac WHERE candid = :candid";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(":candid", $candId, PDO::PARAM_INT);
		$stmt->execute();
		unset($stmt);
		$sql = "INSERT INTO candvac(candid, vacid) VALUES (:candid, :vacid)";
		foreach($vacancies as $key => $value){
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(":candid", $candId, PDO::PARAM_INT);
			$stmt->bindParam(":vacid", $value, PDO::PARAM_INT);
			$stmt->execute();
			unset($stmt);
		}
	}

	public function get_vacancy($id){
		$sql = "SELECT * FROM vacancy WHERE id = :id";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(":id", $id);
		$stmt->execute();
		return $stmt->fetchALL(PDO::FETCH_UNIQUE);
	}

	public function remove($id){
		$sql = "DELETE FROM vacancy WHERE id = :id";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(":id", $id);
		$stmt->execute();
	}
}
