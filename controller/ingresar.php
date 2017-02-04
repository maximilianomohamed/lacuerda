<?php

	session_start();
	require_once('./configTwig.php');
	if(!(isset($_SESSION['rol']))) {
		if(isset($_GET["error"])){
			$datos["error"] = true;
			renderizar('ingresar.html',$datos);
		}
		else{
			if(isset($_GET["correcto"])){
				$datos["correcto"] = true;
				renderizar('ingresar.html',$datos);
			}
		}
		
		renderizar('ingresar.html',array());
	}
	else{
		header('Location: ./backend.php');
	}

?>

	
	