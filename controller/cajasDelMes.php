<?php
	
	session_start();
	require_once('./configTwig.php');
	require_once('../model/abmCaja.php');

	if(isset($_SESSION['rol'])) {
		$datos['user'] = $_SESSION['nombre'];
		if($_SESSION['rol'] == "admin"){
			$datos['direccion'] = "./menu.html";
		}
		else{
			$datos['direccion'] = "./menuBack.html";
		}
		if(isset($_GET['elMes'])){
			$mesActual = $_GET['elMes'];
			$anioActual = $_GET['elAnio'];
		}
		else{
			$mesActual = date("n");
			$anioActual = date("Y");
		}
		switch ($mesActual) {
		    case 1:
		        $datos['mes'] = "Enero"; 
		        break;
		    case 2:
		        $datos['mes'] = "Febrero"; 
		        break;
		    case 3:
		        $datos['mes'] = "Marzo"; 
		        break;
		    case 4:
		        $datos['mes'] = "Abril"; 
		        break;
		    case 5:
		        $datos['mes'] = "Mayo"; 
		        break;
		    case 6:
		        $datos['mes'] = "Junio"; 
		        break;
		    case 7:
		        $datos['mes'] = "Julio"; 
		        break;
		    case 8:
		        $datos['mes'] = "Agosto"; 
		        break;
		    case 9:
		        $datos['mes'] = "Septiembre"; 
		        break;
		    case 10:
		        $datos['mes'] = "Octubre"; 
		        break;
		    case 11:
		        $datos['mes'] = "Noviembre"; 
		        break;
		    case 12:
		        $datos['mes'] = "Diciembre"; 
		        break;

		}
		if(hayCajas($mesActual, $anioActual)){
			$datos['cajas'] = detalleCajas($mesActual, $anioActual);
			$datos['total'] = total($mesActual, $anioActual);
		}
		else{
			$datos['cajas'] = 0;
			$datos['total'] = 0;
				
		}
		if(isset($_GET['correctamente'])){
			$datos['correctamente'] = true;
		}
		if(isset($_GET['noGastos'])){
			$datos['noGastos'] = true;
		}
                if(isset($_GET['noIngresos'])){
			$datos['noIngresos'] = true;
		}
		renderizar('cajaMesActual.html',$datos);
	}
	else{
		header('Location: ./ingresar.php');
	}


	
?>