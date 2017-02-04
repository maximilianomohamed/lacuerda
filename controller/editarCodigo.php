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
		
		$datos['id'] = $_GET["id"];
		$datos['codigo'] = $_GET["cod"];
		if(isset($_GET['yaexiste'])){
			$datos['yaExiste'] = true;
		}
		renderizar('editarCodigo.html',$datos);
		}
	else{
		header('Location: ./ingresar.php');
	}
	

	

	
?>