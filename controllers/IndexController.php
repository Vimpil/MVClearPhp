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
						echo ("login");
						$this->pageData['error'] = "Неправильный логин или пароль";
					}
					break;

				case 'something':
					
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


	public function responces() {
		echo '1.45';
		return 1.45;
	}




}