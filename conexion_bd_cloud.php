<?php
	require 'adodb/adodb.inc.php';

	$host = "localhost";
	$user = "root";
	$pass = "";
	$bd   = "integra";
	
	if (!isset($GLOBALS['db']) || !is_object($GLOBALS['db']))
	{
		$GLOBALS['db'] = NewADOConnection('mysql');

		if (!@$GLOBALS['db']->Connect($host, $user, $pass, $bd))
		{
			echo "<center>Error al conectar con el servidor BD<br />".$GLOBALS['db']->ErrorMsg()."</center>";
			die;
		}
	    $GLOBALS['db']->Execute("set names 'utf8'"); 
	}
	
	$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
?>
