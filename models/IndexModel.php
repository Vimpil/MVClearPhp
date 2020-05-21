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


	// function getUsernames(){

	// 	// if (isset($_POST['something'])){

	// 	// 	$something = $_POST['something'];

	// 	// 	if($something){
	// 	// 		print_r($something);
	// 	// 	}

	// 	// }else{
	// 	// 	echo ' not set ';
	// 	// }

	 
	//  // echo '\$request_url/';

	// 	$record_per_page = 5;  
	// 	$page = '';  
	// 	$output = '';  
	// 	$res = [];
		
	// 	$query = "SELECT * FROM tasks LIMIT $record_per_page";
	// 	$stmt = $this->db->prepare($query);
	// 	$stmt->execute();
		
	// 	while ($row=$stmt->fetch())

	// 	{	
	// 		$id = $row['id'];
	// 	    $name = $row['name'];
	// 	    $email = $row['email'];
	// 	    $task = $row['task'];
	// 	    $res[] = array("id" => $id,"name" => $name,"email" => $email,"task" => $task);
	// 	}

	    
	//     return $res;

 //  	}

	

	function changeTablePage(){

		$record_per_page = 5;  
		$page = '';  
		$output = '';
		$total_records = '';
		$res = [];

		if(isset($_POST["page"]))  
		 {  
		      $page = $_POST["page"];  
		 }  
		 else  
		 {  
		      $page = 1;  
		 }  
		
		$_SESSION['page']='running Fun';
 		$start_from = ($page - 1)*$record_per_page;
 		echo '$page';
 		echo $page;
 		echo '$page';
 		echo $start_from;
 		echo '$page';
 		echo $record_per_page;
 		echo '$page';
		$query = "SELECT * FROM tasks ORDER BY 'id' ASC LIMIT $start_from, $record_per_page";
		
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		$output .= "  
			<table id='myTable'>
	        <tbody>
	        <tr>
	        	<th onclick='sortTable(0)' id='idClick'>id</th>
              	<th onclick='sortTable(1)' id='nameClick'>name</th>
              	<th onclick='sortTable(1)' id='emailClick'>email</th>
              	<th onclick='sortTable(1)' id='taskClick'>task</th>
              	<th onclick='sortTable(1)' id='statusClick'>status</th>
           </tr>  
		";  
		$status='';
		while ($row=$stmt->fetch())

		{	
			if($row["status"]==0){
				$status='<input type="checkbox">';
			}else{
				$status='<input type="checkbox" checked>';
			};

			 $output .= '  
			           <tr>  
			                <td>'.$row["id"].'</td>  
			                <td>'.$row["name"].'</td>  
			                 <td>'.$row["email"].'</td>  
			                <td>'.$row["task"].'</td>  
			                 <td>'.$status.'</td>  
			           </tr>  
			      ';  
		}
		
		$query = "SELECT COUNT(IFNULL(id, 1)) FROM tasks;";
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		while ($row=$stmt->fetch())

		{	
			 $total_records=$row[0];
		}


		$output .= '</table><br /><div align="center">';
		$total_pages = ceil($total_records/$record_per_page);
		for($i=1; $i<=$total_pages; $i++)  
		 {  
		      $output .= "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>";  
		 } 
		

		$res = $output;

	    print_r($res);


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


  	function updateRowStatus(){

  		$id = $_POST["id"];  
  		$status = $_POST["status"];  


		$query = "UPDATE tasks SET status='$status' WHERE id=$id;";

		$stmt = $this->db->prepare($query);
		$stmt->execute();

		echo $id . $status;

  	}

  	
     


	
	
}