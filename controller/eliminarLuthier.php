<?php 
	session_start();

	require_once('../model/abmLuthier.php');
	require_once('../model/abmReparacion.php');
	if(!tieneReparacion($_GET["id"])){
		eliminarLuthier($_GET["id"]);
		header ('Location: ./luthiers.php?correctamente');
	}
	else{
		header ('Location: ./luthiers.php?error');
	}
	
	

	
?>