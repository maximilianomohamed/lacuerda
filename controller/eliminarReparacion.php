<?php 
	session_start();

	require_once('../model/abmReparacion.php');
	//Elimino una reparacion 
	eliminarReparacion($_GET["id"]);
	header ('Location: ./reparaciones.php?correctamente');
	
	
	

	
?>