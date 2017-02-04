<?php 
	session_start();

	require_once('../model/abmCoeficientes.php');
	eliminarCoeficiente($_GET["id"]);
	header ('Location: ./coeficientes.php');

	
?>