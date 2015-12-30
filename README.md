# veotek

Sistema de bitacora Veotek.

En el sistema se ingresan las actividades realizadas dentro de las instalaciones de la empresa. Obtener reportes
por personal, fecha y mes. Además se obtiene el registro de las asistencias a la empresa de todos los empleados.

En la página index está divido en dos secciones. La parte derecha se observa el logo de la empresa y abajo la fecha actual al momento 
de ejecutar la aplicación web. Luego se muestra el menú a vínculos de la aplicación, y por último el cuadro de texto donde el empleado teclea su número de empleado y presionar la tecla "Enter" o "Intro" se registra su hora de entrada.

En el menú se encuentran tres vínculos:

Inicio: Este vínculo se direcciona a la página index de la aplicación
Bitacora. Página donde se registran las actividades en Veotek
Administrador. Este vínculo hace un enlace hacia un login de administrador de este sistema.


A continuación se describen las paginas de la aplicación:

Index.

Esta pagina guarda las entradas y salidas solo las marcadas en el día que se ejecuta la aplicación. Se muestra dos tablas, la primera 
se muestra las horas de entrada de los empleados de Veteok marcados con color verde. La segunda tabla se mostrará cuando el primer 
empleado que registre su salida para salir a comer.

Para generar una entrada, al ingresar el número de empleado, se necesita revisar si estan correctos, la base de datos guarda la 
información del usuario y obtiene la hora de entrada y marca la hora de salida como valor nulo.

Para obtener una hora de salida, el sistema busca mediante el identificador de usuario del último registro y
actualiza la información de nuestra base de datos añadiendo la hora de salida, con esto se observa en pantalla cuando se muestra un 
aviso diciendo su salida.

Al registrar de nuevo su entrada se muestra un aviso en pantalla diciendo que vuelve a trabajar y para generar su salida de trabajo 
muestra en pantalla un mensaje de despedida.

Bitacora.

En esta página todos los usuarios pueden acceder para registrar sus actividades dentro de la empresa. Se encuentran
dos cuadros de texto donde los empleados registran su id de trabajador y su contraseña o nombre de usuario clave.
Además se encuentra un campo de texto donde el empleado debe de registrar la actividad que se ha realizado. Y al enviar
ésta información, se analiza si esta correcta, la base de datos lo guarda y se observa en la página la tarea realizada.

Administrador

En esta página, solo los usuarios con el privilegio de administrador pueden accder a modificar la información de
los usuarios. Al iniciar la sesión se observa la tabla de los empleados y las opciones de ver, crear, modificar y 
eliminar la información del usuario seleccionado. 
"Ver Informamación": Muestra en pantalla la información del empleado.
"Update": El Administrados actualiza la información del empleado. Al momento de terminar de modificar la información del empleado es necesario actualizar la fotografía del empleado.
"Delete": Elimina la información del empleado.

Reportes

En esta sección el administrador accede al sistema para obtener el registro de las entradas y salidas de los empleados, así como 
las actividades realizadas en Veotek. Igual se puede obtener un registro por día o por mes. En esta sección se puede
imprimir la información de sus reportes.

