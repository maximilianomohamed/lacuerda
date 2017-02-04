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
			$datos['reparaciones']= detalleReparaciones();
			if(isset($_GET['correctamente'])){
				$datos['correctamente'] = true;
			}
			else{
			 	if(isset($_GET['error'])){
			 		$datos['error'] = true;
			 	}
			}
			renderizar('reparaciones.html',$datos);
		}
		else{
			header('Location: ./ingresar.php');
		}
		
		
		

?>

	
	