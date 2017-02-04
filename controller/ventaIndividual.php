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
		
			
		$precio= $_POST['precio'];
		if(!(existeProductoId(1111111111))){
			agregarProductoId(1111111111,"varios",$precio,1,1,$precio);
			//agrego el producto a la tabla ventasdeproducto
			agregarProductoVenta(1111111111, 1, $precio);
		}
		else{
			if(!(existeProductoId(1111111112))){
			agregarProductoId(1111111112,"varios",$precio,1,1,$precio);
			//agrego el producto a la tabla ventasdeproducto
			agregarProductoVenta(1111111112, 1, $precio);
			}
			else{
				if(!(existeProductoId(1111111113))){
				agregarProductoId(1111111113,"varios",$precio,1,1,$precio);
				//agrego el producto a la tabla ventasdeproducto
				agregarProductoVenta(1111111113, 1, $precio);
				}
				else{
					if(!(existeProductoId(1111111114))){
					agregarProductoId(1111111114,"varios",$precio,1,1,$precio);
					//agrego el producto a la tabla ventasdeproducto
					agregarProductoVenta(1111111114, 1, $precio);
					}
					}
				}
		}//del primer else 
		
		$detalles=detallesVenta();
		$total = totalVenta();
		$datos['detalles'] = $detalles;
		$datos['total'] = $total;
		$datos['cuotas'] = detallesCoeficientes();
		$datos['venta'] = "encurso";
		renderizar('venta.html', $datos);
	}
	else{
		header('Location: ./ingresar.php');
	}


?>