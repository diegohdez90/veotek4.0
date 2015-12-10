
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="icon" href="img/eo.ico" type="image/gif" sizes="16x16">
<META HTTP-EQUIV="REFRESH" CONTENT="5;URL=bitacora.php">
</head>

<body>
s<?php
if(empty($_POST['actividad']) || empty($_POST['clave'])){
	echo "<div class='container'>
		<div class='error row'> 
			<img id='cargando' src='img/cargando.gif'><br>
			<h2 class='text-center'>Informaci&oacute;n no recibida</h2>
		</div>
	</div>";
	return false;
}
include('conexion.php');
$dia = date("Y-m-d H:i:sa");
$actividad = $_POST['actividad'];
$nombre_usuario = $_POST['clave'];

$id_system = "select idusuario from usuario where nombre = '$nombre_usuario'";
$resEmp = mysql_query($id_system, $conexion) or die(mysql_error());
$total = mysql_num_rows($resEmp);

if($total == 1){
	while ($rowEmp = mysql_fetch_assoc($resEmp)) {
		$id_system = $rowEmp['idusuario'];
	}
	$sql = "insert into bitacora(trabajo,hora,usuario_idusuario) values('$actividad', '$dia','$id_system')";
	$resultado = mysql_query($sql, $conexion) or die(mysql_error());
	echo "<div class='container'>
		<div class='error row'> 
			<img id='cargando' src='img/cargando.gif'><br>
			<h2 class='text-center'>Informaci&oacute;n recibida correctamente</h2>
		</div>
	</div>";
}
else{
	echo "<div class='container'>
		<div class='error row'> 
			<img id='cargando' src='img/cargando.gif'><br>
			<h2 class='text-center'>Revisa tu informacion</h2>
		</div>
	</div>";
	return false;
}





?>
</body>