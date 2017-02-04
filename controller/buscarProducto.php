<?php

	session_start();
	require_once('./configTwig.php');
	require_once('../modelo/conexion.php');
		if(isset($_SESSION['rol'])) {
			$datos['user'] = $_SESSION['nombre'];
			if($_SESSION['rol'] == "admin"){
				$datos['direccion'] = "./menu.html";
			}
			else{
				$datos['direccion'] = "./menuBack.html";
			}
			//Variable de búsqueda
			$consultaBusqueda = $_POST['valorBusqueda'];
			$Mostrar = busquedaDeProducto('%'.$consultaBusqueda.'%');

			//Devolvemos el mensaje que tomará jQuery
				echo $Mostrar;
			}
			else{
				echo "";
			}

			
		}
		else{
			header('Location: ./ingresar.php');
		}
		
		
		

?>
