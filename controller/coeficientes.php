<?php

	session_start();
	require_once('./configTwig.php');
	require_once('../model/abmCoeficientes.php');
	if(isset($_SESSION['rol'])) {
		$datos['user'] = $_SESSION['nombre'];
		if($_SESSION['rol'] == "admin"){
			$datos['direccion'] = "./menu.html";
		}
		else{
			$datos['direccion'] = "./menuBack.html";
		}
		
		$datos['coeficientes']= detallesCoeficientes();
		if(isset($_GET['correctamente'])){
			$datos['correctamente'] = true;
		}
		renderizar('coeficientes.html',$datos);
	}
	else{
		header('Location: ./ingresar.php');
	}


?>

	
	