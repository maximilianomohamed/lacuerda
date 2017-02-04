<?php
	session_start();
	if(!(isset($_SESSION['rol']))) {
		require_once('../model/modelLogin.php');
		//require_once('./errores.php');
		if (isset($_POST["usuario"]) and isset($_POST["contraseña"])) {
			if (consultarExistencia($_POST["usuario"], $_POST["contraseña"])) {
				$sesion = (devolverUser($_POST["usuario"], $_POST["contraseña"]));
				$_SESSION['nombre'] = $sesion->username;
				$_SESSION['rol'] = $sesion->rol;
				$_SESSION['id'] = $sesion->id;
				
				header('Location: ./backend.php');

			}
			else {
				header('Location: ./ingresar.php?error');
			}
		}
	}
	else {
		header('Location: ./backend.php');
	}
?>