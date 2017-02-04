<?php 

	session_start();
	require_once('./configTwig.php');
	require_once('../model/abmGasto.php');
	if(isset($_SESSION['rol'])) {
		$datos['user'] = $_SESSION['nombre'];
		if($_SESSION['rol'] == "admin"){
			$datos['direccion'] = "./menu.html";
		}
		else{
			$datos['direccion'] = "./menuBack.html";
		}
		
		$datos['detalle'] = dameDetalles($_GET["id"]);
		$datos['mes'] = $_GET["mes"];
		$datos['anio'] = $_GET["anio"];
		$datos['id'] = $_GET["id"];
		$datos['tipo'] = $_GET["tipo"];
		renderizar('editarGasto.html',$datos);
	}
	else{
		header('Location: ./ingresar.php');
	}

	

	
?>