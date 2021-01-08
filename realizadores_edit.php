<?php

if($_SERVER['REQUEST_METHOD']=="GET"){
	if (isset($_GET['realizador']) && is_numeric($_GET['realizador'])) {
		$idrRealizador = $_GET['realizador'];
		$con = new mysqli ("localhost","root","","filmes");

		if ($con->connect_errno!=0) {
			echo "<h1>Ocorreu um erro no acesso à base de dados. <br>" .$con->conect_error. "</h1>";
			exit();
		}
		$sql = "Select * from realizadores where id_realizador=?";
		$stm = $con->prepare($sql);
		if($stm!=false) {
			$stm->bind_param("i",$idRealizador);
			$stm->execute();
			$res=$stm->get_result();
			$realizador = $res->fetch_assoc();
			$stm->close();
		}
?>

		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="ISO-8859-1">
			<title>Editar realizador</title>
		</head>
		<body>
		<h1>Editar realizadores</h1>
		<form action="realizadores_update.php" method="post">
			<label>ID realizador</label><input type="text" name="idrealizador" required value ="<?php echo$realizador['id_realizador'];?>"><br>
			<label>Nome</label><input type="text" name="nome" required value ="<?php echo$realizador['nome'];?>"><br>
			<label>Nascionalidade</label><input type="numeric" name="nascionalidade" required value ="<?php echo$realizador['nascionalidade'];?>"><br>
			<label>Data nascimento</label><input type="date" name="data_nascimento" value ="<?php echo$realizador['data_nascimento'];?>"><br>
			<input type="submit" name="enviar"><br>
		</form>
		</body>
		</html>
		<?php
	}
	else {
		echo ('<h1>Houve um erro ao processar o pedido. <br> Dentro de segundos será reencaminhado!</h1>');
		header("refresh=2;url=index.php");
		
	}
}