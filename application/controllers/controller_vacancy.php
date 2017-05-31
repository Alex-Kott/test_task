<?php
include './application/models/model_portfolio.php';

class Controller_Vacancy extends Controller
{

	function __construct()
	{
		$this->model = new Model_Vacancy();
		$this->view = new View();
	}
	
	function action_index()
	{
		$data = $this->model->get_data();		
		$lolModel = new Model_Portfolio();
		$lolModel->get_data();
		$data = "dslcslk";
		$this->view->generate('vacancy_view.php', 'template_view.php', $data);

	}

	function action_list(){
		
	}

	function action_add(){
		$data = $_POST['form'];
		if(isset($_POST['form'])){
			
		}
		$this->view->generate('add_vacancy_view.php', 'template_view.php', $data);
	}
}
