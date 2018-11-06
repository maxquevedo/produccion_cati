<?php
	include("head.php");
	//include("conexion_bd.php");
?>
<br/>
<br/>
<div class="row">
	<div class="col-5 offset-lg-4">
		<img src="img/logo.png" class="img-fluid" width="70%" />
	</div>
</div>
<br/>
<form method="post" name="login" action="login.php" align="center" class="jumbotron">
	<div class="row justify-content-center form-group">
		<div class="col-lg-1">
			<label class="form-contorl" for="user">Usuario</label>	
		</div>	
		<div class="col-lg-2">
			<input type="text" class="form-control" name="user" id="user"/>
		</div>
	</div>
	<div class="row justify-content-center form-group">
		<div class="col-lg-1">
			<label for="pass" class="fom-control">Contraseña</label>			
		</div>
		<div class="col-lg-2">
			<input type="password" class="form-control" name="pass" id="pass">
		</div>
	</div>
	<div class="row justify-content-center">
		<button type="submit" id="btnEntrar" name="btnEntrar" class="btn btn-primary" >Entrar</button>
	</div>
</form>


</div>
</body>
</html>