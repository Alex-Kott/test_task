<?php
//include './application/models/model_candidate.php';

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
		$data = "dslcslk";
		$this->view->generate('vacancy_view.php', 'template_view.php', $data);

	}

	function action_list(){
		$data = $this->model->get_vacancies();
		$this->view->generate('vacancy_list_view.php', 'template_view.php', $data);
	}

	function action_add(){
		if(isset($_POST['form'])){
			$form = $_POST['form'];
			$this->model->add($form);
		} 
		$data = '';
			
		
		$this->view->generate('add_vacancy_view.php', 'template_view.php', $data);
	}


}
