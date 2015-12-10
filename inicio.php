<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="icon" href="img/eo.ico" type="image/gif" sizes="16x16">
<META HTTP-EQUIV="REFRESH" CONTENT="5;URL=administrador.php">
</head>

<body>
<?php
//include ('funciones.php');
//usuario y clave pasados por el formulario

if(empty($_POST['login']) || empty($_POST['password'])){
	echo "<div class='container'>
		<div class='error row'> 
			<img id='cargando' src='img/cargando.gif'><br>
			<h2 class='text-center'>Informaci&oacute;n no recibida</h2>
		</div>
	</div>";
	return false;
}


$login = $_POST['login'];
$password = $_POST['password'];
//usa la funcion conexiones() que se ubica dentro de funciones.php


	include('conexion.php');	//sentencia sql para consultar el nombre del usuario
	$id_system = "select idusuario from usuario where nombre = '$password'";
	$obtener_id_system=mysql_query($id_system,$conexion);
	//si existe inicia una sesion y guarda el nombre del usuario
	if (mysql_num_rows($obtener_id_system)!=0){

		while ($rows = mysql_fetch_assoc($obtener_id_system)) {
			$system_id = $rows['idusuario'];

			$sql = "SELECT * FROM personal WHERE idpersonal='$login' AND usuario_idusuario = '$system_id' and privilegios_idprivilegios = 1";
			//ejecucion de la sentencia anterior
			$ejecutar_sql=mysql_query($sql,$conexion);
			//si existe inicia una sesion y guarda el nombre del usuario
			if (mysql_num_rows($ejecutar_sql)!=0){
				//inicio de sesion
				session_start();
				//configurar un elemento usuario dentro del arreglo global $_SESSION
				$_SESSION['login']=$login;
				//retornar verdadero
				header('Location: administrador.php');
			} else {
					echo "<div class='container'>
						<div class='error row'> 
							<img id='cargando' src='img/cargando.gif'><br>
							<h2 class='text-center'>No tienes los privilegios para ingresar</h2>
						</div>
					</div>";
					return false;
			}
	 	}
		
	} else {
			echo "<div class='container'>
		<div class='error row'> 
			<img id='cargando' src='img/cargando.gif'><br>
			<h2 class='text-center'>Usuario no encontrado</h2>
		</div>
	</div>";
	return false;
	
	}


?>
</body>