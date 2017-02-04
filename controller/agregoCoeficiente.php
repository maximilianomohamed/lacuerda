<?php
	session_start();
	require_once('../model/abmCoeficientes.php');
	require_once('./error.php');
	require_once('./configTwig.php');
	
			$cantCuotas = $_POST["cantCuotas"];
			$coeficiente = $_POST["coeficiente"];
			
				if (!(existeCoeficiente($cantCuotas))) {
					agregarCoeficiente($cantCuotas, $coeficiente);
					header('Location: ../controller/coeficientes.php?correctamente');
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
							renderizar('agregoCoeficiente.html',$datos);
					}
					else{
						header('Location: ./ingresar.php');
					}
				
				}
			


?>