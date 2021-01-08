<?php

if($_SERVER['REQUEST_METHOD']=="POST") {
	$nome="";
	$nacionalidade="";
	$data_nascimento="";
	$idAtor="";

	if(isset($_POST['nome'])) {
		$nome= $_POST['nome'];
	}
	else {
		echo '<script>alert("É obrigatório o preenchimento do nome.");</script>';
	}
	if(isset($_POST['id_ator'])) {
		$idAtor= $_POST['id_ator'];
	}
	if(isset($_POST['nacionalidade'])){
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
		$sql = "update atores set nome=?,nacionalidade=?,data_nascimento=? where id_ator=?";
		$stm = $con->prepare ($sql);

		if ($stm!=false) {
			$stm->bind_param("sssi", $nome, $nacionalidade, $data_nascimento, $idAtor);
			$stm->execute();
			echo'<script>alert("Ator atualizado com sucesso");</script>';
			echo "Aguarde um momento. A reencaminhar página";
			header("refresh:2;url=index.php");
		}
	}
	}

