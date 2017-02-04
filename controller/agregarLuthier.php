<?php

	session_start();
	require_once('./configTwig.php');
	if(isset($_SESSION['rol'])) {
		$datos['user'] = $_SESSION['nombre'];
		if($_SESSION['rol'] == "admin"){
			$datos['direccion'] = "./menu.html";
		}
		else{
			$datos['direccion'] = "./menuBack.html";
		}
		
		renderizar('agregoLuthier.html',$datos);
	}
	else{
		header('Location: ./ingresar.php');
	}
	
		
		

?>

	
	