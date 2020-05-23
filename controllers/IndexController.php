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
						// $this->pageData['loginError'] = "Неправильный логин или пароль";
					}
				
					break;


				case 'addTask':

					if(!$this->addTask()) {
						
					}
					break;


				case 'changeTablePage':

					if(!$this->changeTablePage()) {
						
					}
					break;

				case 'updateRowStatus':

				if(!$this->updateRowStatus()) {
						
					}
					break;

				case 'updateRowTask':

				if(!$this->updateRowTask()) {
						
					}
					break;				


			}
		}

		 
		// print_r($this->model->getUsernames());
		
		// $_SESSION['users'] = $this->model->getUsernames();

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

		$this->changeTablePage();
		
	}

	public function changeTablePage() {

		if(!$this->model->changeTablePage()) {
			return false;
		}
		
	}

	public function updateRowStatus() {

		if(!$this->model->updateRowStatus()) {
			return false;
		}
		
	}

	public function updateRowTask() {

		if(!$this->model->updateRowTask()) {
			return false;
		}
		
	}
	

}


if (is_ajax()) {
  if (isset($_POST["action"]) && !empty($_POST["action"])) { //Checks if action value exists
    $action = $_POST["action"];
    switch($action) { //Switch case for value of action
      case "test": test_function(); break;
    }
  }
}

//Function to check if the request is an AJAX request
function is_ajax() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function test_function(){
  $return = $_POST;
  
  //Do what you need to do with the info. The following are some examples.
  //if ($return["favorite_beverage"] == ""){
  //  $return["favorite_beverage"] = "Coke";
  //}
  //$return["favorite_restaurant"] = "McDonald's";
  
  $return["json"] = json_encode($return);
  echo json_encode($return);
}
?>



