<?php



// if(isset( $_POST['invoiceno'] )) {

// 	$IndexController = new IndexController();
//      $result = $IndexController->getName();
//      echo $result;
// }


/**
 * 
 */
require_once 'IndexController.php';
require_once MODEL_PATH . 'Model.php';
require_once MODEL_PATH . 'IndexModel.php';
class AjaxHandlerController extends IndexController
{
	
	function __construct()
	{
		parent::__construct ();
	}

	function showFeeds () {
        return 'done';
    }
}

$params = $_index -> showFeeds ();

// require_once 'IndexController.php';

// if(isset( $_POST['invoiceno'] )) {
	
// 	$IndexController = new IndexController();

//     // $result = $IndexController->getName();
//     echo '$result';

// }

// require_once 'animal.php';

// if(isset( $_POST['invoiceno'] )) {
//      $myAnimal = new animal();
//      $result = $myAnimal->getName();
//      echo $result;
// }