<?php
	session_start();
	require_once('../model/abmProducto.php');
	require_once('../model/abmMarca.php');
	require_once('./configTwig.php');
	
	$codigobarra= $_POST['codigobarra'];
	$stock= $_POST['stock'];
	$descripcion= $_POST['descripcion'];
	$precio= $_POST['precio'];
	$ganancia= $_POST['ganancia'];
	$marca= $_POST['marca'];
	$preciodeventa = $precio+(($precio * $ganancia)/100);
	$preciodeventa = number_format($preciodeventa,2); 

		if(!(existeProductoCodigo($codigobarra))){
			//me fijo si ese producto ya existe
			if(!(existeProducto($descripcion, $marca, $precio))){
				//no existe entonces lo agrego
					agregarProducto($descripcion,$precio,$marca,$ganancia,$preciodeventa,$codigobarra,$stock);
					header('Location: ../controller/listarProductos.php?correctamente');
				
			}
		}
		else{
				if(isset($_SESSION['rol'])) {
					$datos['user'] = $_SESSION['nombre'];
					if($_SESSION['rol'] == "admin"){
						$datos['direccion'] = "./menu.html";
					}
					else{
						$datos['direccion'] = "./menuBack.html";
					}
					
					//existe entonces devuelvo error no lo agrego
					$datos["yaExiste"] = true;
					$datos["marcas"] = detalleMarcas();
					renderizar('agregoProducto.html',$datos);
				}
				else{
					header('Location: ./ingresar.php');
				}
			
		}



?>