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
	
	public function get_data()
	{	
		
		
		// Здесь мы просто сэмулируем реальные данные.
		
		return array(
			
			array(
				'Year' => '2012',
				'Site' => 'http://DunkelBeer.ru',
				'Description' => 'Промо-сайт темного пива Dunkel от немецкого производителя Löwenbraü выпускаемого в России пивоваренной компанией "CАН ИнБев".'
			),

			array(
				'Year' => '2012',
				'Site' => 'http://ZopoMobile.ru',
				'Description' => 'Русскоязычный каталог китайских телефонов компании Zopo на базе Android OS и аксессуаров к ним.'
			),

			array(
				'Year' => '2012',
				'Site' => 'http://GeekWear.ru',
				'Description' => 'Интернет-магазин брендовой одежды для гиков.'
			),

			array(
				'Year' => '2011',
				'Site' => 'http://РоналВарвар.рф',
				'Description' => 'Промо-сайт мультфильма "Ронал-варвар" от норвежских режиссеров. Мультфильм о самом нетипичном варваре на Земле, переполненный интересными приключениями и забавными ситуациями.'
			),

			array(
				'Year' => '2011',
				'Site' => 'http://TompsonTatoo.ru',
				'Description' => 'Персональный сайт-блог художника-татуировщика Алексея Томпсона из Санкт-Петербурга.'
			),

			array(
				'Year' => '2011',
				'Site' => 'http://DaftState.ru',
				'Description' => 'Страничка музыкальных и сануд продюсеров из команды "DaftState", работающих в стилях BreakBeat и BigBeat.'
			),

			array(
				'Year' => '2011',
				'Site' => 'http://TiltPeople.ru',
				'Description' => 'Сайт сообщества фотографов в стиле Tilt Shif.'
			),

			array(
				'Year' => '2011',
				'Site' => 'http://AbsurdGames.ru',
				'Description' => 'Страничка российской команды разработчиков независимых игр с необычной физикой и сюрреалистической графикой.'
			),

		);
	}

}
