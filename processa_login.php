<?php
session_start();
if ($_SERVER['REQUEST_METHOD']=="POST") {

	if(isset($_POST['user_name'])&& isset($_POST['password'])) {
		$utilizador = $_POST['user_name'];
		$password = $_POST['password'];

		$con = new mysqli("localhost","root","","filmes");

		if($con->connect_errno!=0) {
			echo "Ocorreu um erro no acesso à base de dados. <br>" .$con->connect_error;
			exit;
		}

		else {
			$sql = "Select * from utilizadores where user_name=? and password=?";
			$stm = $con->prepare($sql);
			if($stm!=false) {
		$stm->bind_param("ss", $utilizador, $password);
		$stm->execute();
		$res = $stm->et_result();
		if($res->num_rows==1) {
			$_SESSION['login']="correto";
		}
		else {
			$_SESSION['login']="incorreto";
		}
		header("refresh:2; url=index.php");
	}
	else "Ocorreu um erro no acesso à base de dados. <br> STM:" .$connect_error;
	exit;
			}
		}
	}
}