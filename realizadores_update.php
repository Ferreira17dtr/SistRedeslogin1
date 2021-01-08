<?php

if($_SERVER['REQUEST_METHOD']=="POST") {
	$nome="";
	$data_nascimento="";
	$nacionalidade="";
	$idRealizador="";

	if(isset($_POST['nome'])) {
		$nome= $_POST['nome'];
	}
	else {
		echo '<script>alert("É obrigatório o preenchimento do nome.");</script>';
	}
	if(isset($_POST['idRealizador'])) {
		$idRealizador= $_POST['idRealizador'];
	}
	if (isset($_POST['nacionalidade'])) {
		$nacionalidade = $_POST['nacionalidade'];
	}
	if (isset($_POST['data_nascimento'])) {
		$data_nascimento = $_POST['data_nascimento'];
	}

	$con = new mysqli("localhost","root","","filmes");

	if($con->connect_errno!=0) {
		echo "Ocorreu um erro no acesso à base de dados. <br>" .$con->connect_error;
		exit();
	}
	else {
		$sql = "update realizadores set nome=?,nacionalidade=?,data_nascimento=? where id_realizador=?";
		$stm = $con->prepare ($sql);

		if ($stm!=false) {
			$stm->bind_param("sssi", $nome, $nacionalidade, $data_nascimento, $idRealizador);
			$stm->execute();
			echo'<script>alert("Realizador atualizado com sucesso");</script>';
			echo "Aguarde um momento. A reencaminhar página";
			header("refresh:2;url=index.php");
		}
	}

}