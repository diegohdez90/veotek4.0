<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/imprimir.css">
<link rel="stylesheet" type="text/css" href="css/bitacora.css">
<link rel="icon" href="img/eo.ico" type="image/gif" sizes="16x16">
</head>

<body>
<?php
if(empty($_GET['month'])){
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=reportes.php'>
	<div class='container'>
		<div class='error row'> 
			<img id='cargando' src='img/cargando.gif'><br>
			<h2 class='text-center'>Informaci&oacute;n no recibida</h2>
		</div>
	</div>";
	return false;
}
$number_month = $_GET['month'];
$first_day = $number_month."-01";
$mes = substr($number_month, 5,7);
$meses = array('1' =>  'Enero', 
			'2' =>  'Febrero',
			'3' =>  'Marzo',
			'4' =>  'Abril',
			'5' =>  'Mayo',
			'6' =>  'Junio',
			'7' =>  'Julio',
			'8' =>  'Agosto',
			'9' =>  'Septiembre',
			'10' =>  'Octubre',
			'11' =>  'Noviembre',
			'12' =>  'Diciembre',);
$nombre_mes = $meses[$mes];
$last_day = date("Y-m-t", strtotime($first_day));
?>
	<div class="container">
		<div class="row bitacora">
			<h3>Bitacora del mes de <?php echo $nombre_mes; ?></h3>
			<div class="table-responsive">
				<table class="table">
					<tr>
						<th>ID Personal</th>
						<th>Nombre</th>
						<th>Actividad Relizada</th>
						<th>Hora de Actividad Realizada</th>
					</tr>
					<?php
						include('conexion.php');
						$datos = "select idpersonal,concat(nombre,' ',apellidos) as Nombre,hora,trabajo from bitacora,personal where personal.usuario_idusuario = bitacora.usuario_idusuario and hora >= '$first_day' and hora < '$last_day' order by hora";
						$horario = mysql_query($datos, $conexion) or die(mysql_error());
						$totEmp = mysql_num_rows($horario);
						while ($rows = mysql_fetch_assoc($horario)) {
							echo "<tr>";
							$idpersonal = $rows['idpersonal'];
							echo "<td>".$idpersonal."</td>";
							$nombre = $rows["Nombre"];
							echo "<td>".$nombre."</td>";
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

</body>