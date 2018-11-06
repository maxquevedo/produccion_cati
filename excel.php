<?php
	session_start();
	if(!isset($_SESSION['user'])){
		header('Location: index.php');
	}
	header('X-XSS-Protection:0');
	header("Content-Type: application/vnd.ms-excel");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("content-disposition: attachment;filename= SupervisionCATI-".$_SESSION['mes'].'-'.$_SESSION['anio'].".xls");
	echo $_POST['datos_a_enviar'];
?>