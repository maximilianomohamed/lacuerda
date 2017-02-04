<?php

	session_start();
	require_once('./configTwig.php');
	require_once('../model/abmProducto.php');
		

		if(isset($_SESSION['rol'])) {
			$datos['user'] = $_SESSION['nombre'];
			if($_SESSION['rol'] == "admin"){
				$datos['direccion'] = "./menu.html";
			}
			else{
				$datos['direccion'] = "./menuBack.html";
			}
			$datos['productos']= detalleProductos();
			if(isset($_GET['correctamente'])){
				$datos['correctamente'] = true;
			}
			else{
			 	if(isset($_GET['error'])){
			 		$datos['error'] = true;
			 	}
			}
			if(existeProductoCritico()){
				$datos['stockCritico'] = true;
			}
			renderizar('productos.html',$datos);
		}
		else{
			header('Location: ./ingresar.php');
		}
		
		
		

?>

	
	