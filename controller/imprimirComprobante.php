<?php

	session_start();
	require_once('./configTwig.php');
	require_once('./funciones.php');
	require_once('../model/abmVenta.php');
		require_once('../model/abmCoeficientes.php');
	if(isset($_SESSION['rol'])) {
		$datos['user'] = $_SESSION['nombre'];
		if($_SESSION['rol'] == "admin"){
			$datos['direccion'] = "./menu.html";
		}
		else{
			$datos['direccion'] = "./menuBack.html";
		}
		//fecha del día
		date_default_timezone_set('America/Argentina/Buenos_Aires');
		$datos['fecha']= date('j/m/y');
		if($_POST['venta'] != "Contado" and $_POST['venta'] != "Cuenta Corriente"){
			$cantCuotas = $_POST['venta'];
			$datos['porcentaje'] = porcentajeDeLaCuota($cantCuotas);
			//aumentaEn($porcentaje);
		}
		else{
			$datos['porcentaje'] = false;
		}
		//datos de la factura
		$datos['nombre'] = $_POST['nombre'];
		$datos['apellido'] = $_POST['apellido'];
		$datos['domicilio'] = $_POST['domicilio'];
		$datos['iva'] = $_POST['iva'];
		$datos['venta'] = $_POST['venta'];
		$datos['detalles'] = detallesVenta();
		$datos['total'] = totalVenta();
	
		//renderizar('PDFdetalleOrden.html',$datos);
		  $pagina = 'PDFcomprobante.html';
		  $imprime = "comprobanteX.pdf";
		  imprimirPdf($pagina, $imprime, $datos);

		  
	}
	else{
		header('Location: ./ingresar.php');
	}

		
		

?>