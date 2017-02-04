<?php 
	session_start();

	require_once('../model/abmTarjeta.php');
	//Elimino un movimiento de tarjeta 
	eliminarMoviTarjeta($_GET["id"]);
	header ('Location: ./ventasTarjetas.php?correctamente');
	
	
	

	
?>