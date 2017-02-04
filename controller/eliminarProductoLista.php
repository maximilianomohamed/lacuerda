<?php 
	session_start();

	require_once('../model/abmProducto.php');
	eliminarProducto($_GET["id"]);
	header ('Location: ./listarProductos.php');

	
?>