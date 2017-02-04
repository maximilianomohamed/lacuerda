<?php
      //segmento encargado de la conexion a la base de datos
	  $usuario = "root"; //u559727960_cuerd
	  $bd = "lacuerda"; //	u559727960_cuerd
	  $pass = ""; //123maxi
	  $ruta = "localhost"; //mysql.hostinger.com.ar
	  error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
	  $con = mysql_connect ($ruta, $usuario, $pass, $bd)or die ("problemas con la coneccion".mysql_error());
	  // selecciono la base de datos 
	  mysql_select_db($bd, $con) or  die("Problemas en la seleccion de la base de datos".mysql_error());


?>