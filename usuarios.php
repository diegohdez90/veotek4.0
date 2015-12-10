<?php
	include ('funciones.php');
	if (verificar_usuario()){

echo '<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/users.css">
<link rel="stylesheet" type="text/css" href="css/imprimir.css">
<link rel="icon" href="img/eo.ico" type="image/gif" sizes="16x16">
</head>


<body>

	<div class="container">
		<div class=" header row">
			<div class="col-md-8">
				<h3>Usuarios de Veotek</h3>
			</div>
			<div class="col-md-4">
			<a href="salir.php"/> <p class="text-right">cerrar sesion</p></a>
				<img width="100%" align="center" src="img/veotek.png">			
			</div>
		</div>	';

		include('conexion.php');


echo "
		<div class='users row'>
			<div class='table-responsive'>
				<table class='table table-condensed table-bordered'>
					<tr>
						<th width='20%'>Foto</th>
						<th>ID</th>
						<th>Nombre</th>
						<th>Usuario</th>
					</tr>";


					$datos = "select foto as Foto,idpersonal as ID, concat(personal.nombre,' ',apellidos) as Nombre ,usuario.nombre as Usuario from personal,usuario where usuario_idusuario = idusuario";
						$users = mysql_query($datos, $conexion) or die(mysql_error());
						$totEmp = mysql_num_rows($users);
						while ($rows = mysql_fetch_assoc($users)) {
							echo "<tr>";
							$foto = $rows['Foto'];
							echo "<td><img width='30%'src=".$foto."></td>";
							$idpersonal = $rows['ID'];
							echo "<td>".$idpersonal."</td>";
							$nombre = $rows['Nombre'];
							echo "<td>".$nombre."</td>";
							$usuario = $rows['Usuario'];
							echo "<td>".$usuario."</td>";
							echo "</tr>";
						}
echo "			</table>	
			</div>
		</div>
		<div class='row'>
		<button onclick='window.print()' type='button' id='btnImprimir'></button>
		</div>
	</div>";
		} else {
			header('Location:administrador.php');
		}
?>