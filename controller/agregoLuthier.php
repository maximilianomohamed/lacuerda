<?php
	session_start();
	require_once('../model/abmLuthier.php');
	require_once('./error.php');
	require_once('./configTwig.php');
	
			$nombre = $_POST["nombre"];
			
			
				if (!(existeLuthier($nombre))) {
					agregarLuthier($nombre);
					header('Location: ../controller/luthiers.php?correctamente');
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
							renderizar('agregoLuthier.html',$datos);
					}
					else{
						header('Location: ./ingresar.php');
					}
				
				}
			


?>