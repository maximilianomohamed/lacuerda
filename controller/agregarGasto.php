<?php

	session_start();
	require_once('./configTwig.php');

	if(isset($_SESSION['rol'])) {
		$datos['user'] = $_SESSION['nombre'];
		if($_SESSION['rol'] == "admin"){
			$datos['direccion'] = "./menu.html";
		}
		else{
			$datos['direccion'] = "./menuBack.html";
		}
		if(isset($_GET['mes']) && isset($_GET['anio'])){
			$datos['mes'] = $_GET['mes'];
			$datos['anio'] = $_GET['anio'];
		}

	
		renderizar('agregoGasto.html',$datos);
	}
	else{
		header('Location: ./ingresar.php');
	}

	
		

?>

	
	