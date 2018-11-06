<?php
	if(!isset($_SESSION['user'])){
		header('Location: index.php');
	}
	require('conexion_bd.php');

	//Variables
	$estudios = $_SESSION['estudios'];
	$nombres = $_SESSION['nombres'];
	$mes = $_SESSION['mes'];
	$dias = 0;
	$anio = $_SESSION['anio'];
	$muestra_teorica = $_SESSION['muestra_teorica'];
	$bisiesto = false;
	$relleno = 0;
	$cont =0;
	$total =0;
	$porcentaje_prom=0;
?>
<script language="javascript">
	function tblToExcel(){
	$("#datos_a_enviar").val($("#datos_eviar").html());
	$("#FormularioExportacion").submit();
	}
</script>
<?php
	//TABLA
	echo "<div id='datos_eviar' class='table-responsibe div'>";
		echo "<table class='table table-bordered table-sm table-striped' name='info' id='info'>";
			echo "<thead>";
				//CABECERAS
				echo "<th class='headcol'>Codigo</th>";
				$dias = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
				for ($i=1; $i <= $dias; $i++) { 
					echo "<th>$i</th>";
				}
				echo "<th class='font-weight-bold'>Total</th>";
				echo "<th class='font-weight-bold'>Cuotas</th>";
				echo "<th class='font-weight-bold'>%</th>";
			echo "</thead>";

			//Array suma diaria
			$registro_diario = array_fill(1,$dias+3,0);

			//DATOS TABLA
			echo "<tbody>";
				for ($i=0; $i < count($estudios); $i++) { 
					echo "<tr>";
					//CODIGO
					echo '<td class="headcol"  title="'.$nombres[$i].'">';
					echo $estudios[$i];
					echo "</td>";
					$cont = 0;
					
					//DIAS
                    $sql = "select fechafin, count(*) AS cantidad from datos_{$estudios[$i]}_0 WHERE estado IN (1,5) group by fechafin";
		            if($rs = $GLOBALS['db']->Execute($sql)){
                    	$rst = array();
                    	while (!$rs->EOF)
                    	{
                    	    $dia = (int)date("d", strtotime($rs->fields['fechafin']));
                            $rst[$dia] = $rs->fields['cantidad'];
                            $rs->MoveNext();
                    	}
                    	for ($j=1; $j<= $dias; $j++)
                    	{
                            if (array_key_exists($j, $rst))
                            {
                                    echo "<td>{$rst[$j]}</td>";
                                    $total += $rst[$j];
                                    $registro_diario[$j] += $rst[$j];
                            }
                            else echo "<td>$relleno</td>";
                    	}
                    }

					//TOTAL MENSUAL
					echo "<td class='font-weight-bold'>".$total."</td>";
					$registro_diario[$dias+1] += $total;
					
					//CUOTAS
					echo"<td class='font-weight-bold'>".$muestra_teorica[$i]."</td>";
					$registro_diario[$dias+2] += $muestra_teorica[$i];
					//PORCENTAJE
					if($total == 0){
						$porcentaje = 0;
						echo "<td class='font-weight-bold'>".$porcentaje."</td>";
					}else{
						$porcentaje = round((($total*100) / ($muestra_teorica[$i])),2);
						$porcentaje_prom += $porcentaje;
						echo "<td class='font-weight-bold'>".$porcentaje."%</td>";
					}
					echo "</tr>";
					$total = 0;
				}

				//TOTAL DIARIO
				echo "<tr><td class='headcol'>Total</td>";
				$cont = 0;
				while($cont < $dias){
					echo "<td>".$registro_diario[($cont+1)]."</td>";
					$cont+=1;
				}
				$porcentaje_prom /= $dias;
				echo"<td class='font-weight-bold'>".$registro_diario[$dias+1]."</td>";
				echo "<td class='font-weight-bold'>".$registro_diario[$dias+2]."</td>";
				echo "<td class='font-weight-bold'>".round($porcentaje_prom,2)."%</td>";
				echo "</tr>";
			echo "</tbody>";
		echo "</table>";
	echo "</div>";
	echo "</br>";
?>
	<!-- 	BOTON Excel 	-->
	<form action="excel.php" method="post" target="_blank" id="FormularioExportacion" style='margin-left:500px;'>
	<button class="btn btn-success" type="button" onclick="tblToExcel();"><i class="icon-file icon-white"></i>Exportar a Excel</button>
	<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"/>
	</form>
<?php
	echo "<br/></div>";
	//print_r($_SESSION);
?>		
