<?php
	session_start();
	require_once('../model/abmUsados.php');
	require_once('../model/abmMarca.php');
	require_once('./configTwig.php');
	require_once('../model/abmProducto.php');
	
	$descripcion= $_POST['descripcion'];
	$precio= $_POST['precio'];
	$ganancia= $_POST['ganancia'];
	$marca= $_POST['marca'];
	$preciodeventa = $precio+(($precio * $ganancia)/100);
	$preciodeventa = number_format($preciodeventa,2); 
	$codigobarra=999999999999999999;

		if(!(existeProductoCodigo($codigobarra))){
			//me fijo si ese producto ya existe
			if(!(existeProducto($descripcion, $marca, $precio))){
				//no existe entonces lo agrego
					agregarProductoUsado($descripcion,$precio,$marca,$ganancia,$preciodeventa);
					$articuloReciente=ultimoArticuloAgregado();
					$idArticulo=$articuloReciente->id;

					//imagen
					$nomImg=$idArticulo.".jpg";
					copy($_FILES['foto']['tmp_name'],"../images/portfolio/accesorios/".$idArticulo.".jpg");
		            //fin de la imagen

		            agregarFoto($idArticulo,$nomImg);

					header('Location: ../controller/articulos.php?correctamente');
				
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