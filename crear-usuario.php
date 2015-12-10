<?php

include ('funciones.php');
    if (verificar_usuario()){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/create.css">
  <link rel="icon" href="img/eo.ico" type="image/gif" sizes="16x16">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
  </script>

    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
    	<div class=" header row">
			<div class="col-md-8">
				<h3>Bienvenidos a Veotek<br>Sesi&oacute;n de Administrador</h3>
			</div>
			<div class="col-md-4">
			<a href="salir.php"/> <p class="text-right">cerrar sesion</p></a>
				<img width="100%" align="center" src="img/veotek.png">			
			</div>
		</div>
		<div class="menu row">
			<ul>
        <li><a href="index.php">Inicio</a></li>
				<li><a href="bitacora.php">Bitacora</a></li>
				<li><a href="reportes.php">Reportes</a></li>
				<li><a href="administrador.php">Administrador</a></li>
			</ul>
		</div>

                  <div class=" formulario row">
                    <h3>Crea un nuevo usuario</h3>
             
                    <form class="form-horizontal" action="add-user.php" method="post" enctype="multipart/form-data">

                    <div class="control-group">

                      <fieldset disabled>
                        <div class="control-group <?php echo !empty($idError)?'error':'';?>">
                          <label class="control-label" for="disabledTextInput">ID Personal</label>
                          <input class="form-control" name="id" type="text" id="disabledTextInput" placeholder="ID Personal" value="<?php                             include('conexion.php');
                            $max = 'select max(idpersonal) as max from personal';
                            $result = mysql_query($max, $conexion) or die(mysql_error());
                            while ($rows = mysql_fetch_assoc($result)) {
                               $id = $rows['max']+1;
                               echo $id;
                            }?>">
                        </div>
                      </fieldset>

                    <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                      <label class="control-label">Nombre</label>
                          <input name="nombre" class="form-control" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
                          <?php if (!empty($nameError)): ?>
                              <span class="help-inline"><?php echo $nameError;?></span>
                          <?php endif; ?>
                    </div>

                    <div class="control-group <?php echo !empty($lastnameError)?'error':'';?>">
                      <label class="control-label">Apellidos</label>
                          <input name="apellidos" class="form-control" type="text"  placeholder="Apellidos" value="<?php echo !empty($lastname)?$lastname:'';?>">
                          <?php if (!empty($lastnameError)): ?>
                              <span class="help-inline"><?php echo $lastnameError;?></span>
                          <?php endif; ?>
                    </div>

                    <div class="control-group">
                      <label class="control-label">Privilegios</label>
              <?php
                include('conexion.php');
                    $privilegios = "SELECT * FROM privilegios";
                  $result = mysql_query($privilegios, $conexion) or die(mysql_error());
                  $lista_privilegios = mysql_num_rows($result);
                ?><select class="form-control" id="privilegios" name="privilegios">
                <?php 
                while ($rows = mysql_fetch_assoc($result)) {
              ?><option value="<?php echo $rows['idprivilegios']; ?>"><?php echo $rows['modo']; ?></option><?php
                }
              ?>
              </select>
                    </div>

                     
                  <div class="control-group">
                      <label class="control-label">Foto</label>
                          <input type="file" name="image" />
                  </div>
                    <?php
              if(isset($_GET['fail']))
               {
                ?>
                      <label>Problem While File Uploading !</label>
                      <?php
               }

                    ?>

                      <div class="control-group <?php echo !empty($usernameError)?'error':'';?>">
                      <label class="control-label">Nombre de Usuario</label>
                          <input name="usuario" class="form-control" type="text"  placeholder="Nombre de usuario" value="<?php echo !empty($username)?$username:'';?>">
                          <?php if (!empty($mobileError)): ?>
                              <span class="help-inline"><?php echo $usernameError;?></span>
                          <?php endif;?>
                      </div>
                  </div>
                  <div class="row send">
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success">Crear usuario</button>
                        <a class="btn" href="administrador.php" name="create">Volver Atras</a>
                    </div>
                </div>



                    </form>
                </div>
              <?php
              } else {
      header('Location:administrador.php');
    }
              ?>   
    </div> <!-- /container -->
  </body>
</html>
