<?php
//funcion para conectar a la base de datos y verificar la existencia del usuario
function conexiones($login, $password) {
	//conexion con el servidor de base de datos MySQL
	//$conectar = mysql_connect('localhost','root','141988');
	//mysql_select_db('imsspro',$conectar);
	$conexion = mysql_connect("localhost", "root", "veotek");
	mysql_select_db("veotek2",$conexion);
	//sentencia sql para consultar el nombre del usuario
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
				return true;
			} else {
				//retornar falso
				return false;
			}
	 	}
		
	} else {
		return false;
	
	}
}


//funcion para verificar que dentro del arreglo global $_SESSION existe el nombre del usuario
function verificar_usuario(){
	//continuar una sesion iniciada
	session_start();
	//comprobar la existencia del usuario
	if ($_SESSION['login']){
		return true;
	}
}
?>

