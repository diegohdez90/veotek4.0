<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/imprimir.css">
<link rel="icon" href="img/eo.ico" type="image/gif" sizes="16x16">
</head>



<body>
<?php
$usuario = $_GET['usuario'];
?>
	<div class="container">
		<div class="row">
			<?php
				include('conexion.php');
				$personal = $datos = "select nombre,apellidos from personal where idpersonal = '$usuario'";
				$data = mysql_query($personal, $conexion) or die(mysql_error());
				while ($rows = mysql_fetch_assoc($data)) {
					echo "<h4>Horario de ". $rows['nombre']." ".$rows['apellidos']."</h4>";
				}
				
			?>
			<div class="table-responsive">
				<table class="table">
					<tr>
						<th>D&iacute;a</th>
						<th>Hora de entrada</th>
						<th>Hora de salida</th>
						<th>Tiempo</th>
					</tr>
					<?php
						$usuario = $_GET['usuario'];
						$datos = "select * from horario where personal_idpersonal = '$usuario'";
						$horario = mysql_query($datos, $conexion) or die(mysql_error());
						$totEmp = mysql_num_rows($horario);
						$total = 0;
						while ($rows = mysql_fetch_assoc($horario)) {
							echo "<tr>";
							$dia = $rows['dia_entrada'];
							echo "<td>".$dia."</td>";
							$entrada = $rows['hora_entrada'];
							echo "<td>".$entrada."</td>";
							$salida = $rows['hora_salida'];
							echo "<td>".$salida."</td>";
							$tiempo = $rows['tiempo'];
							echo "<td>".$tiempo."</td>";
							$decimal = $rows['tiempo_decimal'];
							if(!empty($decimal))
							$total = $total + $decimal;
							echo "<td>".$decimal."</td>";
							echo "</tr>";
						}
						
					?>
				</table>
				<h2>Tiempo Total <?php echo $total; ?></h2>
			</div>
		</div>
		<button onclick='window.print()' type='button' id='btnImprimir'></button>
	</div>

</body>