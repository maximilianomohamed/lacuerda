<?php 

	session_start();
	require_once('./configTwig.php');
	require_once('../model/abmLuthier.php');
	if(isset($_SESSION['rol'])) {
		$datos['user'] = $_SESSION['nombre'];
		if($_SESSION['rol'] == "admin"){
			$datos['direccion'] = "./menu.html";
		}
		else{
			$datos['direccion'] = "./menuBack.html";
		}
		
		$datos['nombreLuthier'] = dameNombreLuthier($_GET["id"]);
		$datos['id'] = $_GET["id"];
		renderizar('editarLuthier.html',$datos);
	}
	else{
		header('Location: ./ingresar.php');
	}
	

	
?>