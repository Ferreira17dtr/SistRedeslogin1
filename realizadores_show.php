<?php
if($_SERVER['REQUEST_METHOD']=="GET") {

	if(!isset($_GET['realizador']) || !is_numeric($_GET['realizador'])) {
		echo '<script>alert("Erro ao abrir realizador");</script>';
		echo 'Aguarde um momento. A reencaminhar página';
		header("refresh:2;url=index.php");
		exit();
	}
	$idRealizador=$_GET['realizador'];
	$con=new mysqli("localhost","root","","filmes");

	if($con->connect_errno!=0) {
		echo 'Ocorreu um erro nao acesso à base de dados. <br>' .$con->connect_error;
		exit;
	}
	else {
		$sql = 'select * from realizadores where id_realizador = ?';
		$stm = $con->prepare ($sql);
		if ($stm!=false) {
			$stm->bind_param('i',$idRealizador);
			$stm->execute();
			$res=$stm->get_result();
			$realizador = $res->fetch_assoc();
			$stm->close();
		}
		else {
			echo "<br>";
			echo ($con->error);
			echo '<br>';
			echo "Aguarde um momento. A reencaminhar página";
			echo "<br>";
			header("refresh:2;url=index.php");
		}
	}	//end if - if($con->connect_errno!=0)
}	// if($_SERVER['REQUEST_METHOD']=="GET")
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="IDO-8859-1">
	<title>Detalhes</title>
</head>
<body>
<h1>Deatalhes do realizador</h1>
<?php
if(isset($realizador)){
	echo '<br>';
	echo $realizador['nome'];
	echo '<br>';
	echo $realizador['nacionalidade'];
	echo '<br>';
	echo $realizador['data_nascimento'];
	echo '<br>';
}
else {
	echo '<h2>Parece que o realizador selecionado não existe. <br> Confirme a sua seleção. </h2>';
}
?>
</body>
</html>