<?php


class IndexModel extends Model {

	
	public function checkUser() {

		$login = $_POST['login'];
		$password = md5($_POST['password']);

		$sql = "SELECT * FROM usrdata WHERE login = :login AND password = :password";

		

		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":login", $login, PDO::PARAM_STR);
		$stmt->bindValue(":password", $password, PDO::PARAM_STR);
		$stmt->execute();

		$_SESSION['data1']=$sql;

		$res = $stmt->fetch(PDO::FETCH_ASSOC);

		$_SESSION['data']=$res;

		$_SESSION['datalogin']=$login;
		$_SESSION['datapassword']=$password;

		if(!empty($res)) {
			$_SESSION['role_id'] = '1';
		} else {
			$_SESSION['role_id'] = '0';
			return false;
		}
	}

	
}