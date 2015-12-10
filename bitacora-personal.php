<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/imprimir.css">
<link rel="stylesheet" type="text/css" href="css/bitacora.css">
<link rel="icon" href="img/eo.ico" type="image/gif" sizes="16x16">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>



<body>
<?php
$usuario = $_GET['usuario'];
?>
	<div class="container">
		<div class="row bitacora">
			<div class="table-responsive">
				<table class="table">
					<tr>
						<th>Actividad Relizada</th>
						<th>Hora de Actividad Realizada</th>
					</tr>
					<?php
						include('conexion.php');
						$usuario = $_GET['usuario'];
						$datos = "select * from bitacora where usuario_idusuario = '$usuario'";
						$horario = mysql_query($datos, $conexion) or die(mysql_error());
						while ($rows = mysql_fetch_assoc($horario)) {
							echo "<tr>";
							$actividad = $rows['trabajo'];
							echo "<td>".$actividad."</td>";
							$hora = $rows['hora'];
							echo "<td>".$hora."</td>";
							echo "</tr>";
						}
						
					?>
				</table>
			</div>
		</div>
		<button onclick='window.print()' type='button' id='btnImprimir'></button>
	</div>
<?php
		$usuario = $_GET['usuario'];
		$datos = "select nombre,apellidos from personal where usuario_idusuario = '$usuario'";
		$personal = mysql_query($datos, $conexion) or die(mysql_error());
		while ($rows = mysql_fetch_assoc($personal)) {
			$empleado = $rows['nombre']." ".$rows['apellidos'];
		}
?>

	<script type="text/javascript">
	$(document).ready(function(){
		$('<h3>Bitacora de <?php echo $empleado;?></h3>').insertBefore(".table-responsive")
	});

	</script>

</body>