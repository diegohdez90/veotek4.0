<?php
					include 'conexion.php';

					if(date("w")==1){
						$fin = date("Y-m-d",strtotime("-2 days"));
						$todas_tolerancias = "SELECT * FROM tolerancia";
						$result = mysql_query($todas_tolerancias,$conexion);
						$num_rows = mysql_num_rows($result);
						if($num_rows==0){
							$get_tol = "select nombre,apellidos,tolerancia from personal;";
							$tolerancia = mysql_query($get_tol, $conexion) or die(mysql_error());
							$nrow = mysql_num_rows($tolerancia);
							while ($rs = mysql_fetch_assoc($tolerancia)) {
								$nombre = $rs['nombre']." ".$rs['apellidos'];
								$tol = $rs['tolerancia'];
								$insert_tol = "insert into tolerancia(nombre,tolerancia,fecha) values('$nombre','$tol','$fin')";
								$resultado = mysql_query($insert_tol, $conexion) or die(mysql_error());
							}
							$reiniciar = "update personal set tolerancia='00:00:00'";
							$resultado = mysql_query($reiniciar, $conexion) or die(mysql_error());
						}
						else{
							$ultimo = "SELECT fecha FROM tolerancia ORDER BY fecha DESC LIMIT 1";
							$result = mysql_query($ultimo,$conexion);
							while ($rs=mysql_fetch_assoc($result)) {
								$ultimo_registro = $rs['fecha'];
							}
							$get_tol = "select nombre,apellidos,tolerancia from personal;";
							$tolerancia = mysql_query($get_tol, $conexion) or die(mysql_error());
							$nrow = mysql_num_rows($tolerancia);
							while ($rs = mysql_fetch_assoc($tolerancia)) {
								$nombre = $rs['nombre']." ".$rs['apellidos'];
								$tol = $rs['tolerancia'];
								if($ultimo_registro!=$fin){
									$insert_tol = "insert into tolerancia(nombre,tolerancia,fecha) values('$nombre','$tol','$fin')";
									$resultado = mysql_query($insert_tol, $conexion) or die(mysql_error());
									echo "<h1>Insertando otra vez ".$ultimo_registro." y ".$fin;
								}
							}
							$reiniciar = "update personal set tolerancia='00:00:00'";
							$resultado = mysql_query($reiniciar, $conexion) or die(mysql_error());
						}
					}



?>