<?php

	session_start();
	require_once('./configTwig.php');
	require_once('./funciones.php');
	require_once('../model/abmProducto.php');
	if(isset($_SESSION['rol'])) {
		$datos['user'] = $_SESSION['nombre'];
		if($_SESSION['rol'] == "admin"){
			$datos['direccion'] = "./menu.html";
		}
		else{
			$datos['direccion'] = "./menuBack.html";
		}

		  $datos['detalles'] = dameProductosCriticos();
		  $pagina = 'PDFstockCritico.html';
		  $imprime = "stockCritico.pdf";
		  imprimirPdf($pagina, $imprime, $datos);
		  
	}
	else{
		header('Location: ./ingresar.php');
	}

		
		

?>