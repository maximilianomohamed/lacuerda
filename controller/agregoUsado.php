<?php
	session_start();
	require_once('../model/abmUsados.php');
	require_once('../model/abmMarca.php');
	require_once('./configTwig.php');
	require_once('../model/abmProducto.php');
	require_once('../model/abmImagenes.php');
	
	$descripcion= $_POST['descripcion'];
	$precio= $_POST['precio'];
	$nombre= $_POST['nombre'];
	$marca= $_POST['marca'];
	$preciodeventa = $precio+(($precio * $ganancia)/100);
	$preciodeventa = number_format($preciodeventa,2); 
	$codigobarra=999999999999999999;

		if(!(existeProductoCodigo($codigobarra))){
			//me fijo si ese producto ya existe
			if(!(existeProducto($descripcion, $marca, $precio))){
				//no existe entonces lo agrego
					agregarProductoUsado($descripcion,$marca,$nombre, $precio);
					$articuloReciente=ultimoArticuloAgregado();
					$idArticulo=$articuloReciente->id;

		            //imagen
					agregarFotoN($idArticulo, 'usado');
					$imagenReciente=ultimaImagen();
					$idImagenUlt=$imagenReciente->id;
					$extension = end((explode('.',$_FILES['foto']['name'])));
					$nomImg=$idImagenUlt.'.'.$extension;
					copy($_FILES['foto']['tmp_name'],"../images/portfolio/accesorios/".$nomImg);
					actualizarDatosImagen($idImagenUlt, $nomImg);
				    //fin de la imagen

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