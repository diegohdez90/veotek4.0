<!DOCTYPE html>
<html>
<head>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/imprimir.css">
    <link rel="icon" href="img/eo.ico" type="image/gif" sizes="16x16">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>


<?php

include ('funciones.php');
    if (verificar_usuario()){



        include('conexion.php');
        $id = null;
        if ( !empty($_GET['id'])) {
            $id = $_REQUEST['id'];
        }
         
        if ( null==$id ) {
            header("Location:administrador.php");
        } 
        else {
            $datos = "select idpersonal,concat(nombre,' ',apellidos) as Nombre,foto,privilegios_idprivilegios, usuario_idusuario from personal where idpersonal = '$id'";
            $informacion = mysql_query($datos, $conexion) or die(mysql_error());
            while ($rows = mysql_fetch_assoc($informacion)) {
                $idpersonal = $rows['idpersonal'];
                $nombre = $rows["Nombre"];
                $foto = $rows['foto'];
                $privilegios = $rows['privilegios_idprivilegios'];
                $user_id = $rows['usuario_idusuario'];
            }

            $user_system = "select nombre from usuario where idusuario = '$user_id'";
            $informacion = mysql_query($user_system, $conexion) or die(mysql_error());
            while ($rows = mysql_fetch_assoc($informacion)) {
                $userename = $rows['nombre'];
            }

            $mode = "select modo from privilegios where idprivilegios = '$privilegios'";
            $informacion = mysql_query($mode, $conexion) or die(mysql_error());
            while ($rows = mysql_fetch_assoc($informacion)) {
                $useremode = $rows['modo'];
            }

                            
        }
?>
 

    <div class="container">
     
        <div class="row">
            <h3>Informacion de <?php echo $nombre; ?></h3>
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Parametro</th>
                        <th>Informaci&oacute;n</th>
                    </tr>
                    <tr>
                        <td>Foto</td>
                        <td><?php echo "<img width='10%'src=".$foto.">"; ?></td>
                    </tr>
                    <tr>
                        <td>ID</td>
                        <td><?php echo $idpersonal; ?></td>
                    </tr>
                    <tr>
                        <td>Nombre</td>
                        <td><?php echo $nombre; ?></td>
                    </tr>
                    <tr>
                        <td>Usuario</td>
                        <td><?php echo $userename; ?></td>
                    </tr>
                    <tr>
                        <td>Privilegios</td>
                        <td><?php echo $useremode; ?></td>
                    </tr>
                </table>
            </div>

            <div class="form-actions">
              <a class="btn" href="administrador.php">Atras</a>
              <button onclick="window.print()" type="button" id='btnImprimir'></button>
           </div>
        </div>

<?php
    } else {
                header('Location:administrador.php');
            }
?>  
                    
                 
    </div> <!-- /container -->
  </body>
</html>