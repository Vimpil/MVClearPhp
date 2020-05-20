<?php


class IndexModel extends Model {

	
	public function checkUser() {

		$_SESSION['role_id'] = 0;
		$login = $_POST['login'];
		$password = md5($_POST['password']);

		$query = "SELECT * FROM usrdata WHERE login = :login AND password = :password";

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(":login", $login, PDO::PARAM_STR);
		$stmt->bindValue(":password", $password, PDO::PARAM_STR);
		$stmt->execute();

		$res = $stmt->fetch(PDO::FETCH_ASSOC);


		if(!empty($res)) {
			$_SESSION['role_id'] = 1;
		} 

	}

	public function createTable() {

		/* Getting post data */
		$somthing = $_POST['somthing'];
		$rowperpage = $_POST['rowperpage'];

		/* Count total number of rows */
		$query = "SELECT count(*) as allcount FROM tasks";
		
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		$fetchresult = mysqli_fetch_array($stmt);
		$allcount = $fetchresult['allcount'];

		/* Selecting rows */
		$query = "SELECT * FROM tasks ORDER BY id ASC LIMIT ".$rowid.",".$rowperpage;

		$stmt = $this->db->prepare($query);
		$stmt->execute();	
		
		$users_arr = array();
		$users_arr[] = array("allcount" => $allcount);

		while($row = mysqli_fetch_array($stmt)){
		    
		    $id = $row['id'];
		    $name = $row['name'];
		    $email = $row['email'];
		    $task = $row['task'];
		    

		    $employee_arr[] = array("id" => $id,"name" => $name,"email" => $email,"task" => $task);
		}

		/* encoding array to json format */
		echo json_encode($employee_arr);
		$_SESSION['employee_arr']=$employee_arr;

	}


	function getUsernames(){

		// if (isset($_POST['something'])){

		// 	$something = $_POST['something'];

		// 	if($something){
		// 		print_r($something);
		// 	}

		// }else{
		// 	echo ' not set ';
		// }

	 
	 // echo '\$request_url/';

		$record_per_page = 5;  
		$page = '';  
		$output = '';  
		$res = [];
		
		$query = "SELECT * FROM tasks LIMIT $record_per_page";
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		
		while ($row=$stmt->fetch())

		{	
			$id = $row['id'];
		    $name = $row['name'];
		    $email = $row['email'];
		    $task = $row['task'];
		    $res[] = array("id" => $id,"name" => $name,"email" => $email,"task" => $task);
		}

	    
	    return $res;

  	}

  	function addTask(){
// FROM tasks ORDER BY DESC LIMIT 1";
  		

  		$query = "SELECT * from tasks;";
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		$lastId=[];

		while($row=$stmt->fetch()){
		    
		    $id = $row['id'];
		    $name = $row['name'];
		    $email = $row['email'];
		    $task = $row['task'];
		    

		    $lastId = array("id" => $id,"name" => $name,"email" => $email,"task" => $task);
		}

		$_SESSION['addRow']=$lastId;

  		$name = $_POST['name'];
		$email = $_POST['email'];
		$task = $_POST['task'];
		
		$status = 0;
		$newId=$lastId['id']+1;

		$query = "INSERT INTO tasks VALUES ('$newId', '$name', '$email', '$task', '$status');";

		$stmt = $this->db->prepare($query);
		$stmt->execute();

		// $query = "Delete from tasks where email='email';";
		// $stmt = $this->db->prepare($query);
		// $stmt->execute();


		// $query = "INSERT INTO tasks VALUES ($lastId, $name, $email, $task, $status);";
		// $stmt = $this->db->prepare($query);
		// // $stmt = $this->db->insert('tasks', $data);
		// $stmt->execute();

		

  	}

  	function getUserDetails($postData=array()){
	 
	    $response = array();
	 
	    if(isset($postData['username']) ){
	 
	      // Select record
	      $this->db->select('*');
	      $this->db->where('username', $postData['username']);
	      $records = $this->db->get('users');
	      $response = $records->result_array();
	 
	    }
	 
	    return $response;
  	}     
     


	
	
}