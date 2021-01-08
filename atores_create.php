<?php

if($_SERVER['REQUEST_METHOD']=="POST") {
	$nome="";
	$data_nascimento="";
	$nacionalidade="";

	if(isset($_POST['nome'])){
		$nome=$_POST['nome'];
	}
	else {
		echo '<script>alert("É obrigatório o preenchimento do nome.");</script>';
	}
	if(isset($_POST['nacionalidade'])){
		$nacionalidade=$_POST['nacionalidade'];
	}
	if(isset($_POST['data_nascimento'])) {
		$data_nascimento = $_POST['data_nascimento'];
	}
	$con = new mysqli("localhost","root","","filmes");
	//var_dump($_POST);
	if($con->connect_errno!=0) {
		echo "Ocorreu um erro no acesso à base de dados. <br>" .$con->connect_error;
		exit;
	}

	else {

		$sql = 'insert into atores (nome,nacionalidade,data_nascimento) values(?,?,?)';
		$stm = $con->prepare ($sql);
		if($stm!=false){

			$stm->bind_param('sss', $nome,$nacionalidade,$data_nascimento);
			$stm->execute();
			$stm->close();

			echo'<script>alert("Ator adicionado com sucesso");</script>';
			echo "Aguarde um momento. A reencaminhar página";
			header("refresh:2;url=index.php");

		}
		else {
			echo($con->error);
			echo "Aguarde um momento. A reencaminhar página";
			header("refresh:2;url=index.php");
		}
	}//end if - if($con->connect_errno!=0)
}//if($_SERVER['REUEST_METHOD']=="POST")
else {//else if($_SERVER['REQUST_METHOD']=="POST")

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	<title>Adicionar atores</title>
</head>
<body>
<h1>Adicionar atores</h1>
<form action="atores_create.php" method="post">
<label>Nome</label><input type="text" name="nome" required><br>
<label>Nacionalidade</label><input type="text" name="nacionalidade"><br>
<label>Data nascimento</label><input type="date" name="data_nascimento"><br>
	<input type="submit" name="enviar"><br>
</form>
</body>
</html>
<?php
}//end if - if($_SERVER['REQUEST_METHOD']=="POST")
?>