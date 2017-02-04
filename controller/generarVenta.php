<?php 
	session_start();
	require_once('./configTwig.php');
	require_once('../model/abmProducto.php');
	require_once('../model/abmVenta.php');
	require_once('../model/abmCoeficientes.php');
	if(isset($_SESSION['rol'])) {
		$datos['user'] = $_SESSION['nombre'];
		if($_SESSION['rol'] == "admin"){
			$datos['direccion'] = "./menu.html";
		}
		else{
			$datos['direccion'] = "./menuBack.html";
		}
		//verifico si vino el codigo desde una busqueda por descripcion
		if(isset($_GET['codigoAgregar'])){
			$producto = $_GET['codigoAgregar'];
		}
		else{
			//o si vino por la agregación del codigo de barras
			$producto= $_POST['codigo'];
		}
		if(isset($_POST['cantidad'])){
			$cantidad=$_POST['cantidad'];
			if($cantidad == ''){
				$cantidad = 1;
			}
		}
		else{
			$cantidad = 1;
		}
		
		if (!($producto == '')){
			// verifico la existencia del producto
			if (existeProductoCodigo($producto)) {
				//traigo el id del producto
				$idProducto= dameId($producto);
				//traigo el precio del producto
				$precio = damePrecio($idProducto);
				// disminuyo el stock del producto con la cantidad de la venta
				disminuirStockEn($idProducto, $cantidad);
				
				//me fijo si hay una venta sin finalizar 
				if(ventaSinfinalizar()){
					//me fijo si ese producto ya existe en esta venta
					if(existeProductoVenta($idProducto)){
						//traigo el subtotal anterior
						//$subAnterior = dameSubtotal($producto);
						//si ya existe solo modifico la cantidad vendida
						modificoProductoVenta($idProducto, $cantidad, $precio);
					}
					else{
						//agrego el producto a la tabla ventasdeproducto
						agregarProductoVenta($idProducto, $cantidad, $precio);
					}
					

				}
				else{
					//agrego el producto a la tabla ventasdeproducto
					agregarProductoVenta($idProducto, $cantidad, $precio);
				}
				$detalles=detallesVenta();
				$total = totalVenta();
				$datos['detalles'] = $detalles;
				$datos['total'] = $total;
				$datos['venta'] = "encurso";
				$datos['cuotas'] = detallesCoeficientes();
				renderizar('venta.html', $datos);
			}
			else{
				if(ventaSinfinalizar()){
					// error producto no existe
					$detalles=detallesVenta();
					$total = totalVenta();
					$datos['detalles'] = $detalles;
					$datos['total'] = $total;
					$datos['cuotas'] = detallesCoeficientes();
					$datos['venta'] = "encurso";
				}
				$datos['cuidado'] = "cuidado";
				renderizar('venta.html', $datos);
			}			
		}
		
	}
	else{
		header('Location: ./ingresar.php');
	}

				
	
	
?>