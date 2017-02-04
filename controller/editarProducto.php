<?php 
	session_start();
	require_once('./configTwig.php');
	require_once('../model/abmProducto.php');
	require_once('../model/abmMarca.php');
	if(isset($_SESSION['rol'])) {
		$datos['user'] = $_SESSION['nombre'];
		if($_SESSION['rol'] == "admin"){
			$datos['direccion'] = "./menu.html";
		}
		else{
			$datos['direccion'] = "./menuBack.html";
		}
		
		$datos['todo'] = dameDatos($_GET["id"]);
		$datos['id'] = $_GET["id"];
		$datos['marcas'] = detalleMarcas();
		renderizar('editarProducto.html',$datos);
		}

	else{
		header('Location: ./ingresar.php');
	}

	

	
?>