# veotek

Sistema de bitacora Veotek.

En el sistema se ingresan las actividades realizadas dentro de las instalaciones de la empresa. Obtener reportes
por personal, fecha y mes. Además se obtiene el registro de las asistencias a la empresa de todos los empleados.

En la página index se observa dos cuadros de texto para ingresar su asistencia, uno es su identificador de personal y
el segundo es su contraseña o nombre de usuario. Abajo de este se observa una tabla de asistencia donde se observa
las asistencias de todos los empleados de Veotek

En el menú se encuentran tres vínculos:

Inicio: Este vínculo se direcciona a la página index de la aplicación
Bitacora. Página donde se registran las actividades en Veotek
Reportes. En esta página se pueden obtener los reportes de cada empleado, y sus reportes por día y mes.
Administrador. Este vínculo hace un enlace hacia un login de administrador de este sistema.


A continuación se describen las paginas de la aplicación:

Index.

Esta página genera las entradas y salidas de los empleados de Veotek. Para generar una entrada, al ingresar los datos
necesarios, se necesita revisar si estan correctos, la base de datos guarda la información del usuario y obtiene
la hora de entrada y marca la hora de salida como valor nulo.

Para obtener una hora de salida, el sistema busca mediante el identificador de usaurio del último registro y
actualiza la información de nuestra base de datos añadiendo la hora de salida.
Nota: Para obtener la hora de entrada, el sistema lo busca en el horario, si h

Bitacora.

En esta página todos los usuarios pueden acceder para registrar sus actividades dentro de la empresa. Se encuentran
dos cuadros de texto donde los empleados registran su id de trabajador y su contraseña o nombre de usuario clave.
Además se encuentra un campo de texto donde el empleado debe de registrar la actividad que se ha realizado. Y al enviar
ésta información, se analiza si esta correcta, la base de datos lo guarda y se observa en la página la tarea realizada.

Reportes

En esta sección los usuarios pueden acceder al sistema para obtener el registro de sus entradas y salidas, así como 
las actividades realizadas en Veotek. Igual se puede obtener un registro por día o por mes. En esta sección se puede
imprimir la información.

Administrador

En esta página, solo los usuarios con el privilegio de administrador pueden accder a modificar la información de
los usuarios. Al iniciar la sesión se observa la tabla de los empleados y las opciones de ver, crear, modificar y 
eliminar la información del usuario seleccionado. Al seleccionar la opción de ver se puede imprimir la información
del empledo seleccionado.




