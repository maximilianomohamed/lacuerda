<?php
	session_start();
	require_once('../model/abmLuthier.php');
	require_once('./configTwig.php');
	
			$nombre = $_POST["nombre"];
			$id = $_POST["id"];
				if (!(existeLuthier($nombre))) {
					modificarLuthier($id, $nombre);
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
							$datos["nombreLuthier"] = $nombre;
							$datos["id"] = $id;
							renderizar('editarLuthier.html',$datos);
						}
						else{
							header('Location: ./ingresar.php');
						}
					
				}
			

?>