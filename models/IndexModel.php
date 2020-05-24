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


		// wrong login

		if(!empty($res)) {
			$_SESSION['role_id'] = 1;
		} else{
			$_SESSION['role_id'] = 3;
		}

	}

	public function logout() {

		$_SESSION['role_id'] = 0;

	}	

	function changeTablePage(){

		$record_per_page = 3;  
		$page = '';  
		$output = '';
		$total_records = '';
		$res = [];
		$query = '';
		$status='';
		$ascDesc=$_POST["ascDesc"];

		if(isset($_POST["page"]))  
		 {  
		      $page = $_POST["page"];  
		 }  
		 else  
		 {  
		      $page = 1;  
		 }


		$start_from = ($page - 1)*$record_per_page;



 		if(isset($_POST["tableHead"])){
 			$tableHead = $_POST["tableHead"];
 		}else{
 			$tableHead = 'id';
 		}

 		$query = "SELECT * FROM tasks ORDER BY $tableHead $ascDesc LIMIT $start_from, $record_per_page";
	 	
		$stmt = $this->db->prepare($query);
		$stmt->execute();

		$output .= "  
			<table id='myTable'>
	        <tbody style='width:100%>
	        <tr>
	        	<th id='idClick' name='id' style='display:none'></th>
              	<th id='nameClick' name='name' style='width:30%'>пользователь</th>
              	<th id='emailClick' name='email' style='width:20%'>email</th>
              	<th id='taskClick' name='task' style='width:40%'>текст задачи</th>
              	<th id='statusClick' name='status' style='width:10%'>статус</th>
           </tr>  
		";  

		while ($row=$stmt->fetch())

		{	
			
			if($row["editedTask"]==1){
				$editedTask='<div class = "editedTask">edited</div>';
			}else{
				$editedTask='';
			}

			if($row["status"]==0){
				$status='<input type="checkbox"> '.$editedTask;
			}else{
				$status='<input type="checkbox" checked>'.$editedTask;
			};

			 $output .= '  
			           <tr>  
			                <td style="display:none">'.$row["id"].'</td> 
			                <td>'.htmlspecialchars($row["name"]).'</td>  
			                 <td>'.htmlspecialchars($row["email"]).'</td>  
			                <td>'.htmlspecialchars($row["task"]).'</td>  
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


		$output .= '</table><br /><div align="center" id="table_pages">';
		$total_pages = ceil($total_records/$record_per_page);
		for($i=1; $i<=$total_pages; $i++)  
		 {  
		 	if ($i==$page){
				$output .= "<span class='pagination_link active' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>";
		 	}else{

		      $output .= "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>";  
		  }
		 } 

		$res = $output;

	    print_r($res);

  	}

  	function addTask(){
	
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

		$query = "INSERT INTO tasks VALUES ('$newId', '$name', '$email', '$task', '$status', '0');";

		$stmt = $this->db->prepare($query);
		$stmt->execute();		

  	}


  	function updateRowStatus(){

  		$id = $_POST['id'];  
  		$status = $_POST['status'];  


		$query = "UPDATE tasks SET status='$status' WHERE id=$id;";

		$stmt = $this->db->prepare($query);
		$stmt->execute();

  	}


  	function updateRowTask(){

  		$id = $_POST['id'];  
  		$task = $_POST['task'];  


		$query = "UPDATE tasks SET task='$task', editedTask='1' WHERE id=$id;";

		$stmt = $this->db->prepare($query);
		$stmt->execute();


  	}
	
}