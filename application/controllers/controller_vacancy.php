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
		if(isset($_GET['remove_id'])){
			$id = $_GET['remove_id'];
			$this->model->remove($id);
		}
		$data['vacancies'] = $this->model->get_vacancies();
		$this->view->generate('vacancy_list_view.php', 'template_view.php', $data);
	}

	function action_add(){
		if(isset($_POST['form'])){
			$form = $_POST['form'];
			$this->model->add($form);
		} 
		$data = '';
			
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$vacancy = $this->model->get_vacancy($id);
			//var_dump($vacancy);
			$data['vacancy'] = $vacancy[$id];
			$data['vacancy']['id'] = $id;

			$vacancyModel = new Model_Vacancy();
			$candidates = $vacancyModel->get_candidates_for_vacancy($id);
			$data['candidates'] = $candidates;
			
			$this->view->generate('add_vacancy_view.php', 'template_view.php', $data);
		} else {
			$this->view->generate('add_vacancy_view.php', 'template_view.php', $data);	
		}
		
		
	}


}
