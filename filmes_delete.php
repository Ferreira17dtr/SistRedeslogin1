<?php
if($_SERVER['REQUEST_METHOD']=="GET") {
	if(isset($_GET['filme']) && is_numeric($_GET['filme'])) {
		$idFilme = $_GET['filme'];
		$con = new mysqli("localhost", "root","","filmes");

		if ($con->connect_errno!=0) {
			echo "Ocorreu um erro no acesso à base de dados. <br> ".$con->connect_error;
			exit;
		}
		else {
			$sql = "delete from filmes where id_filme=?";
			$stm=$con->prepare($sql);
			if($stm!=false) {
			$stm->bind_param("i",$idFilme);
			$stm->execute();
			$stm->close();
			echo '<script>alert("Livro eliminado com sucesso");</script>';
			echo 'Aguarde um momento. A reencaminhar página';
			header("refresh:2;url=index.php");
		}
		else {
			echo "<br>";
			echo ($con->error);
			echo "<br>";
			echo "Aguarde um momento. A reencaminhar página";
			echo "<br>";
			header("refresh:2;url=index.php");
		}
	}
}
else {
	echo "<h1>Houve um erro ao processar o seu pedido!<br>irá ser reencaminhado!</h1>";
	header("refresh:2;url=index.php");
	}
}
else {
	echo "<h1>Houve um erro ao processar o seu pedido!<br>irá ser reencaminhado!</h1>";
	header("refresh:2;url=index.php");
	}
	?>
