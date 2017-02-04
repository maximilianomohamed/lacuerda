<?php 
	session_start();

	require_once('../model/abmUser.php');
	eliminarUsuario($_GET["id"]);
	header ('Location: ./usuarios.php');

	
?>