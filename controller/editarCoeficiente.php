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
		
		$datos['detalle'] = detallesDelCoeficiente($_GET["id"]);
		renderizar('editarCoeficiente.html',$datos);
	}
	else{
		header('Location: ./ingresar.php');
	}
	

	
?>