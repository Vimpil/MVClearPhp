<?php


class IndexController extends Controller {
	
	private $pageTpl = '/views/main.tpl.php';


	public function __construct() {
		$this->model = new IndexModel();
		$this->view = new View();
	}


	public function index() {
		$this->pageData['title'] = "Вход в личный кабинет";

		if(!empty($_POST)) {
			$action = $_POST['action'];
			
			switch ($action) {

				case 'login':
					if(!$this->login()) {
						$this->pageData['error'] = "Неправильный логин или пароль";
					}
					break;
				
			}
		}

		$this->view->render($this->pageTpl, $this->pageData);
	}


	public function login() {

		if(!$this->model->checkUser()) {
			return false;
		}
		
	}	



}