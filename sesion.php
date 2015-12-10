<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="icon" href="img/eo.ico" type="image/gif" sizes="16x16">
</head>


<body>

	<div class="container">
		<div class=" header row">
			<div class="col-md-8">
				<h3>Bienvenidos a Veotek<br>Sesi&oacute;n de Administrador</h3>
			</div>
			<div class="col-md-4">
				<img width="100%" align="center" src="img/veotek.png">
			</div>
		</div>
		<div class="menu row">
			<ul>
				<li><a href="index.php">Inicio</a></li>
				<li><a href="bitacora.php">Bitacora</a></li>
				<li><a href="administrador.php">Administrador</a></li>
			</ul>
		</div>
		<div class="register row">
			<form action="inicio.php" method="post" ctype="multipart/form-data">
				<label>Numero de empleado</label><input placeholder="Numero de empleado" name="login">
				<label>Nombre de Usuario</label><input type="password" placeholder="Nombre de usuario" name="password">
				<input type="submit" value="Iniciar sesi&oacute;n">
			</form>
		</div>
