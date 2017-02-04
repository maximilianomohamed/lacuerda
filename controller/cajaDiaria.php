<?php
	
	session_start();
	require_once('./configTwig.php');
	require_once('../model/abmCaja.php');
	//seteo la zona horaria de argentina
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	$fecha = date('y/m/j');
	if(isset($_SESSION['rol'])) {
		$datos['user'] = $_SESSION['nombre'];
		if($_SESSION['rol'] == "admin"){
			$datos['direccion'] = "./menu.html";
		}
		else{
			$datos['direccion'] = "./menuBack.html";
		}
		
		if(cajaAbierta($fecha)){
		
			$datos['total'] = cajaActual($fecha);
		}
		else{
			$datos['total'] = 0;
				
		}
		renderizar('caja.html',$datos);
	}
	else{
		header('Location: ./ingresar.php');
	}
	
?>