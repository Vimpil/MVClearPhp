<?php

require_once('Controller.php');


class IndexController extends Controller {
	
	private $pageTpl = '/views/main.tpl.php';


	public function __construct() {
		$this->model = new IndexModel();
		$this->view = new View();
	}


	public function index() {

		$this->pageData['title'] = "Список задач";
		$_SESSION['role_id'] = 0;

		if(!empty($_POST)) {
			$action = $_POST['action'];
			
			
			switch ($action) {

				case 'login':
					if(!$this->login()) {
						$this->pageData['loginError'] = "Неправильный логин или пароль";
					}
					break;

				case 'name':
					if(!$this->addTask()) {
						
					}
					break;
				
			}
		}

		 
		print_r($this->model->getUsernames());
		
		$_SESSION['users'] = $this->model->getUsernames();

		$this->view->render($this->pageTpl, $this->pageData);
	}


	public function login() {

		if(!$this->model->checkUser()) {
			return false;
		}
		
	}

	public function addTask() {

		if(!$this->model->addTask()) {
			return false;
		}
		
	}


	public function responces() {
		echo '1.45';
		return 1.45;
	}

	public function getName()
	  {		
     
     		return '$result';

	  }


}

// if(isset( $_POST['action'] )) {

// 	echo 'smth';
// 	// print_r($_POST['action']);
// }

