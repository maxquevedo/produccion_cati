<?php
	session_start();
	include("head.php");
	//include("conexion_bd.php");
	if(!isset($_SESSION['user'])){
		header("Location: index.php");
	}
?>
<br/>
<div class='container'>	
	<form name="datos" action="estudios.php" method="post">
		<div class="row justify-content-left">
			<div class="col-0">
				<label for="mes">Mes</label>
			</div>
			<div class="col-2">
				<select id="mes" name="mes" class="form-control" required="required">
				<option value="01" selected>Enero</option>
				<option value="02">Febrero</option>
				<option value="03">Marzo</option>
				<option value="04">Abril</option>
				<option value="05">Mayo</option>
				<option value="06">Junio</option>
				<option value="07">Julio</option>
				<option value="08">Agosto</option>
				<option value="09">Septiembre</option>
				<option value="10">Octubre</option>
				<option value="11">Noviembre</option>
				<option value="12">Diciembre</option>
				</select>
			</div>
			<div class="col-0">
				<label for="anio">Año</label>
			</div>
			<div class="col-2">
				<select name= "anio" id="anio" class="form-control" required>
					<?php
						for ($i=2016; $i <= date('Y') ; $i++) { 
							echo "<option value='$i'>".$i."</option>";
						}
					?>
				</select>
			</div>
			<div class="col-0">
				Servidor
			</div>
			<div class="col-2">
				<select id="servidor" name="servidor" class="form-control">
					<option value="Activa">Activa</option>
					<option value="Cloud">Cloud</option>
				</select>
			</div>
			<div class="col-3">
				<button type="submit" id="btnBuscar" name="btnBuscar" class="btn btn-info">Buscar</button>
			</div>
	</form>
	<form method="get" action="cerrar_sesion.php">
		<div class="col-2">
			<button class="btn btn-success" type="submit">Cerrar Sesion</button>
		</div>
	</form>
</div>
</div>
<br/>
<div id="content">
	<?php
		if(isset($_POST['anio'])){
			require("contenido.php");
			require("tabla.php");
		}
	?>
</div>
<script type="text/javascript">
	if(<?php echo $_POST['mes'];?> >= 10){
		var mes = <?php echo $_POST['mes'];?>
	}else{
		var mes = '0'+<?php echo $_POST['mes'];?>;
	}
	var año = <?php echo $_POST['anio'];?> ;
	var serv = <?php echo "'".$_POST['servidor']."'";?>;
	$("#mes option[value="+mes+"]").attr('selected','selected');
	$("#anio option[value="+año+"]").attr('selected','selected');
	$("#servidor option[value="+serv+"]").attr('selected','selected');
</script>
</body>
</html>