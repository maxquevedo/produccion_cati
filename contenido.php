<?php
	if(!isset($_SESSION['user'])){
		header('Location: index.php');
	}
	if($_POST["servidor"] == "Activa"){
	require('conexion_bd.php');
	}else{
		require('conexion_bd_cloud.php');
	}
	$estudios = Array();
	$nombres = Array();
	$cuotas = Array();
	$busca_anio = $_POST['anio'];
	$busca_mes = $_POST['mes'];
	$array_names = Array();
	$dias = cal_days_in_month(CAL_GREGORIAN, $busca_mes, $busca_anio);
	$sql = "select * from estudios where (fecha_alta <= '{$busca_anio}-{$busca_mes}-{$dias} 23:59:59') AND (fecha_cierre IS NULL OR fecha_cierre >= '{$busca_anio}-{$busca_mes}-01 00:00:00')";
	//echo "<b>$sql<b><br/>";
	//echo "<table class='table'><thead><th>Codigo</th><th>Inicio</th><th>Fin</th></thead><tbody>";
	if($rs = $GLOBALS['db']->Execute($sql)){		
		while(!$rs->EOF){
	//		echo "<tr>";
			$inicio = gmdate("d-m-Y",strtotime($rs->fields['fecha_alta']));
			$fin = gmdate("d-m-Y",strtotime($rs->fields['fecha_cierre']));
			$mes_inicio = substr($inicio,3,2);
			$anio_inicio = substr($fin,3,2);
			$mes_fin = substr($inicio,6,4);
			$anio_fin = substr($fin,6,4);
			$nombre = $rs->fields['nom_estudio'];
	//		echo "<td>".$nombre."</td>";
	//		echo "<td>".$inicio."</td>";
	//		echo "<td>".$fin."</td>";
			array_push($estudios,$rs->fields['cod_estudio']);
			array_push($nombres,$nombre);
			array_push($cuotas,$rs->fields['muestra_teorica']);
			$rs->MoveNext();
	//		echo "</tr>";
		}
	//	echo "</tbody></table>";
	}
	$_SESSION['estudios'] = $estudios;
	$_SESSION['nombres'] = $nombres;
	$_SESSION['mes'] = $_POST['mes'];
	$_SESSION['anio'] = $_POST['anio'];
	$_SESSION['muestra_teorica'] = $cuotas;

?>