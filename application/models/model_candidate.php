<?php

class Model_Candidate extends Model
{
	public function __construct(){
		$this->dbh = new PDO("pgsql:dbname=test_task;host=localhost;user=test_user;password=qwerty"); 
	}

	public function add($form){
		$sql = "INSERT INTO candidate(name, surname, email, lastdate, status) VALUES (:name, :surname, :email, :lastdate, :status)";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(":name", $form['name']);
		$stmt->bindParam(":surname", $form['surname']);
		$stmt->bindParam(":email", $form['email']);
		$stmt->bindParam(":lastdate", $form['lastdate']);
		$stmt->bindParam(":lastdate", $form['lastdate']);
		$stmt->bindParam(":status", $form['status']);
		$stmt->execute();
		$person = $this->get_person_by_email($form['email']);
		var_dump($person);
		return $person;
	}

	public function get_candidates(){
		$sql = "SELECT * FROM candidate";
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute();
		return $stmt->fetchALL(PDO::FETCH_UNIQUE);
	}

	public function remove($id){
		$sql = "DELETE FROM candidate WHERE id = :id";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(":id", $id);
		$stmt->execute();
	}

	public function get_person($id){
		$sql = "SELECT * FROM candidate WHERE id = :id";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(":id", $id);
		$stmt->execute();
		return $stmt->fetchALL(PDO::FETCH_UNIQUE);
	}

	public function get_person_by_email($email){
		$sql = "SELECT * FROM candidate WHERE email = :email";
		$stmt = $this->dbh->prepare($sql);
		$stmt->bindParam(":email", $email);
		$stmt->execute();
		return $stmt->fetchALL(PDO::FETCH_UNIQUE);
	}

}
