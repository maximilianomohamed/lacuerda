<?php 
	session_start();

	require_once('../model/abmMarca.php');
	eliminarMarca($_GET["id"]);
	header ('Location: ./listarMarcas.php');

	
?>