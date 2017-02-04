<?php 

	session_start();
	require_once('./configTwig.php');
	require_once('../model/abmReparacion.php');
	require_once('../model/abmLuthier.php');
	if(isset($_SESSION['rol'])) {
		$datos['user'] = $_SESSION['nombre'];
		if($_SESSION['rol'] == "admin"){
			$datos['direccion'] = "./menu.html";
		}
		else{
			$datos['direccion'] = "./menuBack.html";
		}

		$datos['luthiers'] = detalleLuthiers();
		$datos['detalle'] = dameDatosReparacion($_GET["id"]);
		renderizar('editarReparacion.html',$datos);
	}
	else{
		header('Location: ./ingresar.php');
	}
	

	
?>