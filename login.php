<?php
	session_start();
	const USER = "admin";
	const PASS= "admin";
	//const pass = "4ct1v4.1nt3gr4";

	if( isset($_POST['user']) && isset($_POST['pass']) ){
		$usuario = $_POST['user'];
		$contr = $_POST['pass'];
		$_SESSION['user'] = $usuario;
		if( $usuario == USER && $contr == PASS)
			header("Location: estudios.php");
		else{
			echo "<script>alert('Usuario o Contraseña incorrectos');";
			echo "window.location.href='index.php' </script>";
		}

	}else{
		echo "No tienes permiso para ver esto.";
	}
?>