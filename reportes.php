<?php

include ('funciones.php');
    if (verificar_usuario()){

?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/reportes.css">
<link rel="icon" href="img/eo.ico" type="image/gif" sizes="16x16">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>


<div class="container">
		<div class=" header row">
			<div class="col-md-8">
				<h3>Bienvenidos a Veotek<br>Consulta tu bitacora</h3>
			</div>
			<div class="col-md-4">
				<img width="100%" align="center" src="img/veotek.png">
			</div>
		</div>
		<div class="menu row">
			<ul>
				<li><a href="index.php">Inicio</a></li>
				<li><a href="bitacora.php">Bitacora</a></li>
				<li><a href="administrador.php">Administrador</a></li>
				<li><a href="reportes.php">Reportes</a></li>
			</ul>
		</div>
		<div class="actividades row ">
				<h2>Bitacora</h2>

				<label><b>Personal<b></label><br>
				<form action="bitacora-personal.php" method="get" enctype="multipart/form-data">
					<?php
						include('conexion.php');
				      	$personal = "SELECT nombre,apellidos,usuario_idusuario FROM personal order by nombre";
				    	$result = mysql_query($personal, $conexion) or die(mysql_error());
				    	$totEmp = mysql_num_rows($result);
				    ?><select id="personal" name="usuario">
				    <?php	
						while ($rows = mysql_fetch_assoc($result)) {
					?><option value="<?php echo $rows['usuario_idusuario']; ?>"><?php echo $rows['nombre'].' '.$rows['apellidos']; ?></option><?php
				 		}
				 	?>
				 	</select>
				 	
			        <input type="submit" id="submit" value="Buscar" >
			    </form>

				<form action="bitacora-diaria.php" method="get" enctype="multipart/form-data">
					<label><b>Diario<b></label><br>
				    <input type="date" name="date">
			        <input type="submit" id="submit" value="Buscar" >
			    </form>

				<form action="bitacora-mensual.php" method="get" enctype="multipart/form-data">
					<label><b>Mensual<b></label><br>
				    <input type="month" name="month"><input type="submit" id="submit" value="Buscar" ></form>

			
		</div>


		<div class="row horario">
				<h2>Horario</h2>

				<form action="horario-personal.php" method="get" enctype="multipart/form-data">
					<label><b>Personal<b></label><br>
					<?php
						include('conexion.php');
				      	$personal = "SELECT nombre,apellidos,idpersonal FROM personal order by nombre";
				    	$result = mysql_query($personal, $conexion) or die(mysql_error());
				    	$totEmp = mysql_num_rows($result);
				    ?><select id="personal" name="usuario">
				    <?php	
						while ($rows = mysql_fetch_assoc($result)) {
					?><option value="<?php echo $rows['idpersonal']; ?>"><?php echo $rows['nombre'].' '.$rows['apellidos']; ?></option><?php
				 		}
				 	?>
				 	</select>
				 	
			        <input type="submit" id="submit" value="Buscar" ></form>

				<form action="horario-diario.php" method="get" enctype="multipart/form-data">
					<label><b>Diario<b></label><br>
				    <input type="date" name="date">
			        <input type="submit" id="submit" value="Buscar" ></form>

				<form action="horario-mensual.php" method="get" enctype="multipart/form-data">
					<label><b>Mensual<b></label><br>
				    <input type="month" name="month"><input type="submit" id="submit" value="Buscar" ></form>
			</div>	
		</div>


<?php
} else {
			header('Location:administrador.php');
		}
?>
</body>