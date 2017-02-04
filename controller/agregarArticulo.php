<?php

	session_start();
	require_once('./configTwig.php');
	require_once('../model/abmMarca.php');
	if(isset($_SESSION['rol'])) {
		$datos['user'] = $_SESSION['nombre'];
		if($_SESSION['rol'] == "admin"){
			$datos['direccion'] = "./menu.html";
		}
		else{
			$datos['direccion'] = "./menuBack.html";
		}
		
		$datos['marcas']= detalleMarcas();
		renderizar('agregoArticulo.html',$datos);
	}
	else{
		header('Location: ./ingresar.php');
	}
	
		
		

?>

	