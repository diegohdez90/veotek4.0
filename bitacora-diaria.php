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
$tomorrow = new DateTime('tomorrow');
$tday =  $tomorrow->format('Y-m-d H:i:s');
if(empty($_GET['date'])){
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=reportes.php'>
	<div class='container'>
		<div class='error row'> 
			<img id='cargando' src='img/cargando.gif'><br>
			<h2 class='text-center'>Informaci&oacute;n no recibida</h2>
		</div>
	</div>";
	return false;
}
$fecha =  $_GET['date']." 00:00:00";
$annio = substr($fecha, 0,4);
$mes = substr($fecha, 5,2);
$dia = substr($fecha, 8,2);
$meses = array('01' =>  'Enero', 
			'02' =>  'Febrero',
			'03' =>  'Marzo',
			'04' =>  'Abril',
			'05' =>  'Mayo',
			'06' =>  'Junio',
			'07' =>  'Julio',
			'08' =>  'Agosto',
			'09' =>  'Septiembre',
			'10' =>  'Octubre',
			'11' =>  'Noviembre',
			'12' =>  'Diciembre',);
$nombre_mes = $meses[$mes];
	?>
	<div class="container">
		<div class="row bitacora">
			<h3>Bitacora del <?php echo $dia." de ".$nombre_mes. " del ".$annio; ?></h3>
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
						$datos = "select idpersonal,concat(nombre,' ',apellidos) as Nombre,hora,trabajo from bitacora,personal where personal.usuario_idusuario = bitacora.usuario_idusuario and hora >= '$fecha' and hora <= '$tday' order by hora";
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