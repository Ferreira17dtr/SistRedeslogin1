<?php

if($_SERVER['REQUEST_METHOD']=="GET"){
	if (isset($_GET['ator']) && is_numeric($_GET['ator'])) {
		$idAtor = $_GET['ator'];
		$con = new mysqli ("localhost","root","","filmes");

		if ($con->connect_errno!=0) {
			echo "<h1>Ocorreu um erro no acesso à base de dados. <br>" .$con->conect_error. "</h1>";
			exit();
		}
		$sql = "Select * from atores where id_ator=?";
		$stm = $con->prepare($sql);
		if($stm!=false) {
			$stm->bind_param("i",$idAtor);
			$stm->execute();
			$res=$stm->get_result();
			$ator = $res->fetch_assoc();
			$stm->close();
		}
?>

		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="ISO-8859-1">
			<title>Editar ator</title>
		</head>
		<body>
		<h1>Editar atores</h1>
		<form action="atores_update.php" method="post">
			<label>ID ator</label><input type="text" name="id_ator" required value ="<?php echo$ator['id_ator'];?>"><br>
			<label>Nome</label><input type="text" name="nome" required value ="<?php echo$ator['nome'];?>"><br>
			<label>Nacionalidade</label><input type="text" name="nacionalidade"  value ="<?php echo$ator['nacionalidade'];?>"><br>
			<label>Data nascimento</label><input type="date" name="data_nascimento" value ="<?php echo$ator['data_nascimento'];?>"><br>
			<input type="submit" name="enviar"><br>
		</form>
		</body>
		</html>
		<?php
	}
	else {
		echo ('<h1>Houve um erro ao processar o pedido. <br> Dentro de segundos será reencaminhado!</h1>');
		header("refresh=5;url=index.php");
		
	}
}