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

	public function linkVacanciesToCandidate($candId, $vacancies){
		var_dump($candId);
		var_dump($vacancies);
		$sql = "INSERT INTO candvac(candid, vacid) VALUES (:candid, :vacid)";
		foreach($vacancies as $key => $value){
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindParam(":candid", $candId, PDO::PARAM_INT);
			$stmt->bindParam(":vacid", $value, PDO::PARAM_INT);
			$stmt->execute();
			unset($stmt);
		}
	}

	public function get_candidates_for_vacancy($vacId){
		$sql = "SELECT * FROM candvac WHERE vacid = :vacid";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(":vacid", $vacId, PDO::PARAM_INT);
		$stmt->execute();
		
	}
}
