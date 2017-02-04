<?php

	session_start();
	require_once('./configTwig.php');
	require_once('../model/abmReparacion.php');
	if(isset($_SESSION['rol'])) {
		$datos['user'] = $_SESSION['nombre'];
		if($_SESSION['rol'] == "admin"){
			$datos['direccion'] = "./menu.html";
		}
		else{
			$datos['direccion'] = "./menuBack.html";
		}
		
		$datos['detalles'] = dameDatosReparacion($_GET['id']);
		$datos['precioPagar'] = dameManoDeObraReparacion($_GET['id']);
		if(isset($_GET['correctamente'])){
			$datos['correcto']= true;
		}
		renderizar('detalleReparacion.html',$datos);
		
	}
	else{
		header('Location: ./ingresar.php');
	}

		
		

?>