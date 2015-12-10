<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/bitacora.css">
<link rel="icon" href="img/eo.ico" type="image/gif" sizes="16x16">
</head>


<body>

	<div class="container">
		<div class=" header row">
			<div class="col-md-8">
				<h3>Bienvenidos a Veotek<br>Registra tu actividad</h3>
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
		<div class="row bitacora">
			<form id="actividades" action="actividades.php" method="post" ctype="multipart/form-data">
				<label>Nombre de usuario</label><input type="password" placeholder="Nombre de usuario" name="clave">
				<input type="submit" value="Registra tu actividad">
			</form>
			<textarea rows="4" cols="50" name="actividad" form="actividades" placeholder="Escribe aqui la actividad realizada en Veotek"></textarea>
		</div>

		<div class="table-responsive actividades">
			<table class="table">
				<tr>
					<th>ID Personal</th>
					<th>Nombre</th>
					<th>Apellidos</th>
					<th>Actividad</th>
					<th>Hora</th>
				</tr>
				<?php
					include('conexion.php');
					$datos = "select idpersonal,nombre,apellidos,trabajo,hora from bitacora,personal where bitacora.usuario_idusuario = personal.usuario_idusuario";
					$horario = mysql_query($datos, $conexion) or die(mysql_error());
					$totEmp = mysql_num_rows($horario);
					while ($rows = mysql_fetch_assoc($horario)) {
						echo "<tr>";
						$idpersonal = $rows['idpersonal'];
						echo "<td>".$idpersonal."</td>";
						$nombre = $rows['nombre'];
						echo "<td>".$nombre."</td>";
						$apellido = $rows['apellidos'];
						echo "<td>".$apellido."</td>";
						$trabajo = $rows['trabajo'];
						echo "<td>".$trabajo."</td>";
						$hora = $rows['hora'];
						echo "<td>".$hora."</td>";
						echo "</tr>";
					}
					
				?>
			</table>
		</div>
	</div>
	
</body>