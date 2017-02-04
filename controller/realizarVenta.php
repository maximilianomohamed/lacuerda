<?php

	session_start();
	require_once('./configTwig.php');
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
		
		if(ventaSinfinalizar()){
			$detalles=detallesVenta();
			$total = totalVenta();
			$datos['detalles'] = $detalles;
			$datos['total'] = $total;
			$datos['venta'] = "encurso";
			$datos['cuotas'] = detallesCoeficientes();
		}  
		renderizar('venta.html',$datos);
	}
	else{
		header('Location: ./ingresar.php');
	}

		
		

?>

	
	