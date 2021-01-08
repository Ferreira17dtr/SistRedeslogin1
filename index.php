<?php
session_start();
$con=new mysqli("localhost","root","","filmes");

if($con->connect_errno!=0) {
	echo "Ocorreu um erro no acesso à base de dados." .$con->connect_error;
	exit;
}
else {
	if(!isset($_SESSION['login'])) {
		$_SESSION['login']="correto";
	}
	if ($_SESSION['login']=="incorreto"){
	}
?>
		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="ISO-8859-1">
			<title>filmes</title>
		</head>
		<body>			
			<a href="http://localhost/filmes_create.php"><h1>Criar filmes</h1></a>
		<h1>Lista de filmes</h1>
		<?php
		$stm = $con->prepare('select * from filmes');
		$stm -> execute();
		$res=$stm->get_result();
		while($resultado = $res->fetch_assoc()) {

			echo '<a href="http://localhost/filmes_edit.php?filme=' .$resultado['id_filme'].'">';
			echo ' editar '.'</a>';
			echo '<a href="http://localhost/filmes_delete.php?filme=' .$resultado['id_filme'].'">';
			echo ' eliminar '.'</a>';
			echo '<a href="filmes_show.php?filme=' .$resultado['id_filme']. '">';
			echo $resultado['titulo'];
			echo '<br>';
			
			echo '</a>';

		}
		$stm->close();
		?>
	<br>

	<a href="http://localhost/atores_create.php"><h1>Criar atores</h1></a>
		<h1>Lista de atores</h1>
		<?php
		$stm = $con->prepare('select * from atores');
		$stm -> execute();
		$res=$stm->get_result();
		while($resultado = $res->fetch_assoc()) {

			echo '<a href="http://localhost/atores_edit.php?ator=' .$resultado['id_ator'].'">';
			echo ' editar '.'</a>';
			echo '<a href="atores_show.php?ator=' .$resultado['id_ator']. '">';
			echo $resultado['nome'];
			echo '<br>';
			echo '</a>';

		}
		$stm->close();
		?>

		<br>

		<a href="http://localhost/realizadores_create.php"><h1>Criar realizadores</h1></a>
		<h1>Lista de realizadores</h1>
		<?php
		$stm = $con->prepare('select * from realizadores');
		$stm -> execute();
		$res=$stm->get_result();
		while($resultado = $res->fetch_assoc()) {

			echo '<a href="http://localhost/realizadores_edit.php?realizador=' .$resultado['id_realizador'].'">';
			echo ' editar '.'</a>';
			echo '<a href="realizadores_show.php?realizador=' .$resultado['id_realizador']. '">';
			echo $resultado['nome'];
			echo '<br>';
			echo '</a>';

		}
		$stm->close();
		?>
	

		</body>
		</html>

		<?php
	} //end if($con->connect_errno!=0)
	?>




