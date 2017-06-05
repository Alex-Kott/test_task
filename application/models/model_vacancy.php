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
}
