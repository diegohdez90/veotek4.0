<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/create.css">
  <link rel="icon" href="img/eo.ico" type="image/gif" sizes="16x16">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<?php

include ('funciones.php');
  if (verificar_usuario()){


    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        //header("Location: administrador.php");
    }

    if ( !empty($_POST)) {
      $idError = null;
      $nameError = null;
      $lastnameError = null;
      $modeError = null;
      $photoError = null;
      $userError = null;

      $name = $_POST['nombre'];
      $lastname = $_POST['apellidos'];
      $mode = $_POST['privilegios'];
      $username = $_POST['usuario'];
      $userid = $_POST['userid'];

      $valid = true;
      if (empty($id)) {
          $idError = 'De un id de personal';
          $valid = false;
      }
       
      if (empty($name)) {
          $nameError = 'De un nombre';
          $valid = false;
      }
      
      if (empty($lastname)) {
          $lastnameError = 'De los apellidos';
          $valid = false;
      }
           
          
      $picture_tmp = $_FILES['image']['tmp_name'];
      $picture_name = $_FILES['image']['name'];
      $picture_type = $_FILES['image']['type'];

      $allowed_type = array('image/png', 'image/gif', 'image/jpg', 'image/jpeg');

      if(in_array($picture_type, $allowed_type)) {
          $path = 'img/profiles/'.$picture_name; //change this to your liking
           move_uploaded_file($picture_tmp, $path);
      } else {
          $error[] = 'File type not allowed';
          $valid=false;
      }

      
          // insert data
          if ($valid) {
            include('conexion.php');

            $update_user = "update usuario set nombre ='$username' where idusuario=  '$userid'";
            $update = mysql_query($update_user, $conexion) or die(mysql_error());
                      
            $update_info = "update personal set nombre = '$name', apellidos = '$lastname', privilegios_idprivilegios = '$mode', usuario_idusuario = '$userid', foto = '$path' where idpersonal = '$id'";

            $resultado = mysql_query($update_info, $conexion) or die(mysql_error());

            if ($resultado) {
              echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=administrador.php'>
              <div class='container'>
                <div class='error row'> 
                  <img id='cargando' src='img/cargando.gif'><br>
                  <h2 class='text-center'>Informaci&oacute;n actualizada correctamente</h2>
                </div>
              </div>";
              return true;
            }
            else{
              echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=administrador.php'>
              <div class='container'>
                <div class='error row'> 
                  <img id='cargando' src='img/cargando.gif'><br>
                  <h2 class='text-center'>Informaci&oacute;n no actualizada correctamente</h2>
                </div>
              </div>";
              return false;
            }

          }
          else{
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=administrador.php'>
        <div class='container'>
        <div class='error row'> 
          <img id='cargando' src='img/cargando.gif'><br>
          <h2 class='text-center'>Informaci&oacute;n no recibida</h2>
        </div>
      </div>";
        }
      }
      else
      {
        include('conexion.php');
        $personal = "select * from personal where idpersonal = '$id'";
        $informacion = mysql_query($personal, $conexion) or die(mysql_error());
        while ($rows = mysql_fetch_assoc($informacion)) {
            $namecomplete = $rows["nombre"].' '.$rows['apellidos'];
            $name = $rows['nombre'];
            $lastname = $rows['apellidos'];
            $photo = $rows['foto'];
            $mode = $rows['privilegios_idprivilegios'];
            $userid = $rows['usuario_idusuario'];
        }


          $system = "select nombre from usuario where idusuario = '$userid'";
          $user = mysql_query($system, $conexion) or die(mysql_error());
          while ($rows = mysql_fetch_assoc($user)) {
              $username = $rows['nombre'];
          }

      }
      

    
  ?>




 
 
<body>
    <div class="container">
     


                  <div class=" formulario row">
                    <h3>Actualizar informacion de <?php echo $namecomplete; ?></h3>
             
                    <form class="form-horizontal" action="actualizar.php?id=<?php echo $id?>" method="post" enctype="multipart/form-data">

                      <fieldset disabled>
                        <div class="control-group <?php echo !empty($idError)?'error':'';?>">
                          <label class="control-label" for="disabledTextInput">ID Personal</label>
                          <input class="form-control" name="id" type="text" id="disabledTextInput" placeholder="ID Personal" value="<?php echo !empty($id)?$id:'';?>">
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
                          <input name="apellidos" class="form-control" type="text"  placeholder="Apellidos" value="<?php echo !empty($lastname)?$lastname:''; ?>">
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
                        <img src="<?php echo "$photo";?>" width="10%">
                      <label class="control-label">Actualiza tu Foto</label>
                          <input type="file" name="image" />
                  </div>

                      <div class="control-group <?php echo !empty($usernameError)?'error':'';?>">
                      <label class="control-label">Nombre de Usuario</label>
                          <input name="usuario" class="form-control" type="text"  placeholder="Nombre de usuario" value="<?php echo !empty($username)?$username:'';?>">
                          <input name="userid" class="form-control" type="hidden" value="<?php echo$userid ?>">
                          <?php if (!empty($mobileError)): ?>
                              <span class="help-inline"><?php echo $usernameError;?></span>
                          <?php endif;?>
                      </div>
                  </div>
                  <div class="row send">
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success actualizar">Actualizar informaci&oacute;n</button>
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
