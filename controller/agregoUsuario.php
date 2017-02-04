<?php
	session_start();
	require_once('../model/abmUser.php');
	require_once('./configTwig.php');
	
			$nombre = $_POST["nombre"];
			$contrasenia = $_POST["contrasenia"];
			$rol = $_POST["rol"];
			
			if (!(existeUsuario($nombre))) {
				agregarUsuario($nombre, $contrasenia,$rol);
				header('Location: ../controller/usuarios.php?correctamente');
			}
			else {
				if(isset($_SESSION['rol'])) {
					$datos['user'] = $_SESSION['nombre'];
					if($_SESSION['rol'] == "admin"){
						$datos['direccion'] = "./menu.html";
					}
					else{
						$datos['direccion'] = "./menuBack.html";
					}
					
					$datos["yaExiste"] = true;
					renderizar('agregoUsuario.html',$datos);
				}
				else{
					header('Location: ./ingresar.php');
				}
				
			}



?>