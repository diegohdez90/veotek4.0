<?php
	include ('funciones.php');
	if (verificar_usuario()){

echo '<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/users.css">
<link rel="icon" href="img/eo.ico" type="image/gif" sizes="16x16">
</head>


<body>

	<div class="container">
		<div class=" header row">
			<div class="col-md-8">
				<h3>Bienvenidos a Veotek<br>Sesi&oacute;n de Administrador</h3>
			</div>
			<div class="col-md-4">
			<a href="salir.php"/> <p class="text-right">cerrar sesion</p></a>
				<img width="100%" align="center" src="img/veotek.png">			
			</div>
		</div>
		<div class="menu row">
			<ul>
				<li><a href="index.php">Inicio</a></li>
				<li><a href="bitacora.php">Bitacora</a></li>
				<li><a href="reportes.php">Reportes</a></li>
				<li><a href="administrador.php">Administrador</a></li>
			</ul>
		</div>';

		include('conexion.php');


echo "
		<div class='users row'>
			<h3>Usuarios registrados</h3>
			<p>
                <a href='crear-usuario.php' class='btn btn-success'>Crear usuario</a>
                <a href='usuarios.php' class='btn btn-success'>Ver usuarios registradros</a>

            </p>
			<div class='table-responsive'>
				<table class='table table-condensed table-bordered'>
					<tr>
						<th width='20%'>Foto</th>
						<th>ID</th>
						<th>Nombre</th>
						<th>Usuario</th>
						<th>Tolerancia</th>
						<th>Acci&oacute;n</th>
					</tr>";

					$datos = "select foto as Foto,idpersonal as ID, concat(personal.nombre,' ',apellidos) as Nombre ,usuario.nombre as Usuario,tolerancia from personal,usuario where usuario_idusuario = idusuario";
						$users = mysql_query($datos, $conexion) or die(mysql_error());
						$totEmp = mysql_num_rows($users);
						while ($rows = mysql_fetch_assoc($users)) {
							echo "<tr>";
							$foto = $rows['Foto'];
							echo "<td><img width='10%'src=".$foto."></td>";
							$idpersonal = $rows['ID'];
							echo "<td>".$idpersonal."</td>";
							$nombre = $rows['Nombre'];
							echo "<td>".$nombre."</td>";
							$usuario = $rows['Usuario'];
							echo "<td>".$usuario."</td>";
							$tolerancia = $rows['tolerancia'];
							echo "<td>".$tolerancia."</td>";
							echo "<td><a class='btn btn-default	' href='info.php?id=".$rows['ID']."'>Ver informaci&oacute;n</a>";
							echo " ";
							echo '<a class="btn btn-success" href="actualizar.php?id='.$rows['ID'].'">Update</a>';
							echo ' '; 
							echo '<a class="btn btn-danger" href="eliminar.php?id='.$rows['ID'].'">Delete</a>';
							echo "</tr>";
						}
echo "			</table>	
			</div>
		</div>
";

		print "";
		} else {
			header('Location:sesion.php');
		}
?>
<?php
?>