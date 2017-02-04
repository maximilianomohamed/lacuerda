<?php

	session_start();
	require_once('./configTwig.php');
	require_once('./funciones.php');
	require_once('../model/abmReparacion.php');
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	if(isset($_SESSION['rol'])) {
		$datos['user'] = $_SESSION['nombre'];
		if($_SESSION['rol'] == "admin"){
			$datos['direccion'] = "./menu.html";
		}
		else{
			$datos['direccion'] = "./menuBack.html";
		}
		
		//formateo la fecha para acomodarla como dia mes y año
		$fecha= dameFecha($_GET['id']); 
		$miFecha = DateTime::createFromFormat('Y-m-d', $fecha);
		$fechaFormateada = $miFecha->format('d/m/Y');
		$datos['fecha']= $fechaFormateada;

		$datos['detalles'] = dameDatosReparacion($_GET['id']);
		//renderizar('PDFdetalleOrden.html',$datos);
		  $pagina = 'PDFdetalleOrden.html';
		  $imprime = "detalleOrden.pdf";
		  imprimirPdf($pagina, $imprime, $datos);
		  
	}
	else{
		header('Location: ./ingresar.php');
	}

		
		

?>