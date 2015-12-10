<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="icon" href="img/eo.ico" type="image/gif" sizes="16x16">
<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=index.php">
</head>
<body>

	<?php

	if(empty($_POST['clave'])){
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=index.php'>
		<div class='container'>
			<div class='error row'> 
				<img id='cargando' src='img/cargando.gif'><br>
				<h2 class='text-center'>Informaci&oacute;n no recibida</h2>
			</div>
		</div>";
		return false;
	}
	include('conexion.php');
	$dia = date("Y-m-d");
	$hora = date("H:i:sa");
	$clave = $_POST['clave'];



	$select_if_out = "select * from horario where personal_idpersonal='$clave' and dia_entrada='$dia' and (hora_entrada and hora_salida) is not null and despues_entrada is null";
	$result_select_if_out = mysql_query($select_if_out,$conexion);
	$nrows = mysql_num_rows($result_select_if_out);
	if ($nrows==1) {
		$insertar_segunda_salida = "update horario set despues_entrada='$hora' where personal_idpersonal='$clave' and dia_entrada='$dia'";
		$result = mysql_query($insertar_segunda_salida,$conexion);
		if($result){
					echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=index.php'>
					<div class='container'>
						<div class='error row'> 
							<img id='cargando' src='img/cargando.gif'><br>
							<h2 class='text-center'>Regresando a trabajar</h2>
						</div>
					</div>";
		}
	}else{
		$select_if_out = "select * from horario where personal_idpersonal='$clave' and dia_entrada='$dia' and (hora_entrada and hora_salida and despues_entrada) is not null";
		$result_select_if_out = mysql_query($select_if_out,$conexion);
		$nrows = mysql_num_rows($result_select_if_out);
		if($nrows==1){
			$select_if_in = "select * from horario where personal_idpersonal='$clave' and dia_entrada='$dia' and despues_salida is null";
			$result_select_if_in = mysql_query($select_if_in,$conexion);
			$nrows = mysql_num_rows($result_select_if_in);
			if ($nrows==1) {
				while ($rs = mysql_fetch_assoc($result_select_if_in)) {
					$hora_entrada =  $rs['despues_entrada'];	
					$hora_salida = substr($hora, 0,8);
					$t = $rs['tiempo'];
					$t_d = $rs['tiempo_decimal'];

					$total      = strtotime($hora_salida) - strtotime($hora_entrada);
					$hours      = floor($total / 60 / 60);
					$minutes    = round(($total - ($hours * 60 * 60)) / 60);

					$tiempo = $hours.':'.$minutes;

					$hm = explode(":", $tiempo);
					$res = ($hm[0] + ($hm[1]/60));

					$t = $t.':00';
					$tiempo = $tiempo.":00";
					$primer = strtotime($t) -strtotime("00:00:00");
					$segundo = strtotime($tiempo)- strtoupper("00:00:00");
					$sumtime = date("H:i:s",$primer+$segundo);
					$total = $t_d+$res;
					$insertar_segunda_salida = "update horario set despues_salida='$hora',despues_tiempo='$tiempo',despues_tiempo_decimal='$res',total='$sumtime',total_decimal='$total' where personal_idpersonal='$clave' and dia_entrada='$dia'";
					$result = mysql_query($insertar_segunda_salida,$conexion);
					if($result){
					echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=index.php'>
						<div class='container'>
							<div class='error row'> 
								<img id='cargando' src='img/cargando.gif'><br>
								<h2 class='text-center'>Excelente Noche</h2>
							</div>
						</div>";
					}

				}

			}
			else{
				echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=index.php'>
					<div class='container'>
						<div class='error row'> 
							<h2 class='text-center'></h2>
						</div>
					</div>";

			}	

		}else{
				echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=index.php'>
					<div class='container'>
						<div class='error row'> 
							<h2 class='text-center'></h2>
						</div>
					</div>";

		}

	}


	$select_user = "select * from horario where personal_idpersonal='$clave' and dia_entrada='$dia'";
	$result_select_user = mysql_query($select_user,$conexion);
	$nrows = mysql_num_rows($result_select_user);

	if($nrows==0){
		$insertar_entrada = "insert into horario(dia_entrada,hora_entrada,personal_idpersonal) values('$dia','$hora','$clave')";
		$result = mysql_query($insertar_entrada,$conexion);
		if($result){
					echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=index.php'>
		<div class='container'>
			<div class='error row'> 
				<img id='cargando' src='img/cargando.gif'><br>
				<h2 class='text-center'>Ingresando entrada</h2>
			</div>
		</div>";
		}
		else{
					echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=index.php'>
		<div class='container'>
			<div class='error row'> 
				<img id='cargando' src='img/cargando.gif'><br>
				<h2 class='text-center'>Oh no</h2>
			</div>
		</div>";
			
		}
	}else{
		$select_if_entrada = "select * from horario where personal_idpersonal='$clave' and dia_entrada='$dia' and hora_salida is null";
		$result_select_if_entrada = mysql_query($select_if_entrada,$conexion);
		$nrows = mysql_num_rows($result_select_if_entrada);

		if ($nrows==1) {
			while ($rs = mysql_fetch_assoc($result_select_if_entrada)) {
				$hora_entrada =  $rs['hora_entrada'];	
				$hora_salida = substr($hora, 0,8);

				$total      = strtotime($hora_salida) - strtotime($hora_entrada);
				$hours      = floor($total / 60 / 60);
				$minutes    = round(($total - ($hours * 60 * 60)) / 60);

				$tiempo = $hours.':'.$minutes;

				$hm = explode(":", $tiempo);
				$res = ($hm[0] + ($hm[1]/60));
			}


			$insertar_salida = "UPDATE horario SET hora_salida='$hora',tiempo='$tiempo',tiempo_decimal='$res' WHERE personal_idpersonal='$clave' and hora_entrada = '$hora_entrada'";
			$result = mysql_query($insertar_salida,$conexion);
			if($result){
							echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=index.php'>
			<div class='container'>
				<div class='error row'> 
					<img id='cargando' src='img/cargando.gif'><br>
					<h2 class='text-center'>Registrando salida</h2>
				</div>
			</div>";

			}
		}
		else{
/*					echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=index.php'>
		<div class='container'>
			<div class='error row'> 
				<img id='cargando' src='img/cargando.gif'><br>
				<h2 class='text-center'>Error al ingresar salida</h2>
			</div>
		</div>";*/

		}

	}

	if(date("w")==6){
		if($hora>="08:50:00"&&$hora<="12:50:00"){
			$get_tol = "select tolerancia from personal where '$clave'=idpersonal;";
			$tolerancia = mysql_query($get_tol, $conexion) or die(mysql_error());	
			while ($rs = mysql_fetch_assoc($tolerancia)) {
				$tol = $rs['tolerancia'];

				$total      = strtotime($hora) - strtotime("08:50:00");
				$hours      = floor($total / 60 / 60);
				$minutes    = round(($total - ($hours * 60 * 60)) / 60);

				$tiempo = $hours.":".$minutes.':00';
				$mi_tolerancia = strtotime($tol) -strtotime("00:00:00");
				$tolerancia_hoy = strtotime($tiempo)- strtoupper("00:00:00");
				$sumtime = date("H:i:s",$mi_tolerancia+$tolerancia_hoy);
	
				$sumar = "update personal set tolerancia='$sumtime' where idpersonal='$clave'";
				$resultado = mysql_query($sumar, $conexion) or die(mysql_error());
			}

		}						
	}
	else{
		if($hora>="08:20:00"&&$hora<="12:50:00"){
			$get_tol = "select tolerancia from personal where '$clave'=idpersonal;";
			$tolerancia = mysql_query($get_tol, $conexion) or die(mysql_error());	
			while ($rs = mysql_fetch_assoc($tolerancia)) {
				$tol = $rs['tolerancia'];

				$total      = strtotime($hora) - strtotime("08:20:00");
				$hours      = floor($total / 60 / 60);
				$minutes    = round(($total - ($hours * 60 * 60)) / 60);

				$tiempo = $hours.":".$minutes.':00';
				$mi_tolerancia = strtotime($tol) -strtotime("00:00:00");
				$tolerancia_hoy = strtotime($tiempo)- strtoupper("00:00:00");

				$sumtime = date("H:i:s",$mi_tolerancia+$tolerancia_hoy);
				$sumar = "update personal set tolerancia='$sumtime' where idpersonal='$clave'";
				$resultado = mysql_query($sumar, $conexion) or die(mysql_error());
			}
		}
	}


	?>

</body>
