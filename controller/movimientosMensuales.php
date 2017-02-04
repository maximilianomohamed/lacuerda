<?php
	
	session_start();
	require_once('./configTwig.php');
	require_once('../model/abmMovimientos.php');
	if(isset($_SESSION['rol'])) {
		$datos['user'] = $_SESSION['nombre'];
		if($_SESSION['rol'] == "admin"){
			$datos['direccion'] = "./menu.html";
		}
		else{
			$datos['direccion'] = "./menuBack.html";
		}
		
		if(isset($_GET['correctamente'])){
			$datos['correctamente'] = true;
		}
		if(isset($_GET['noGastos'])){
			$datos['noGastos'] = true;
		}
		$datos['movimientos'] = detalleMovimientos();			
		renderizar('movimientos.html',$datos);
	}
	else{
		header('Location: ./ingresar.php');
	}

	
?>