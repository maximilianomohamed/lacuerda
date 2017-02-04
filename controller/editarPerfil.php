<?php 

	session_start();
	require_once('./configTwig.php');
	require_once('../model/abmUser.php');
	$name = $_POST['nombre'];
	$contra= $_POST['pass'];
	$id = $_POST['id'];
	modificarUsuario($name, $contra, $id);
	if (isset($_SESSION['rol'])) {
		session_destroy();
	}
	header('Location: ./ingresar.php?correcto');

	
?>