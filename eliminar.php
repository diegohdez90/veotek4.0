<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/delete.css">
<link rel="icon" href="img/eo.ico" type="image/gif" sizes="16x16">
</head>


<body>



<?php
include ('funciones.php');
    if (verificar_usuario()){

        include('conexion.php');
        $id = 0;
         
        if ( !empty($_GET['id'])) {
            $id = $_REQUEST['id'];
        }
        if ( !empty($_POST)) {
            
            $id = $_POST['id'];
             
            $iduser = "select usuario_idusuario from personal where idpersonal = '$id'";
            $info = mysql_query($iduser, $conexion) or die(mysql_error());
            while ($rows = mysql_fetch_assoc($info)) {
                $user = $rows['usuario_idusuario'];
            }

            echo $user;
            $delete = "delete from personal where idpersonal = '$id'";
            $info_delete = mysql_query($delete, $conexion) or die(mysql_error());

            $delete_user = "delete from usuario where idusuario = '$user'";
            $user_delete = mysql_query($delete_user, $conexion) or die(mysql_error());

            if($info_delete && $user_delete){
                echo "<META HTTP-EQUIV=0REFRESH' CONTENT='5;URL=administrador.php'>
                <div class='container'>
                        <div class='error row'> 
                            <img id='cargando' src='img/cargando.gif'><br>
                            <h2 class='text-center'>Se elimino el usuario</h2>
                        </div>
                    </div>";
                    return true;
            }

        }
    ?>

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
     
                <div class="row delete">
                        <h3>Eliminar usuario</h3>
                     
                    <form class="form-horizontal" action="eliminar.php" method="post">
                      <input type="hidden" name="id" value="<?php echo $id;?>"/>
                      <p class="alert alert-error">Estas seguro borrar?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="administrador.php">No</a>
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
