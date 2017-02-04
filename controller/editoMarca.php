<?php

	require_once('../model/abmMarca.php');
	require_once('./configTwig.php');
	
			$nombre = $_POST["nombre"];
			$id = $_POST["id"];
				if (!(existeMarca($nombre))) {
					modificarMarca($id, $nombre);
					header('Location: ../controller/listarMarcas.php?correctamente');
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
							$datos["nombre"] = $nombre;
							$datos["id"] = $id;
							renderizar('editarMarca.html',$datos);
						}
						else{
							header('Location: ./ingresar.php');
						}
					
				}
			

?>