<?php

	session_start();
	require_once('./configTwig.php');
	require_once('../model/abmVenta.php');
	require_once('../model/abmProducto.php');

	if(isset($_SESSION['rol'])) {
		$datos['user'] = $_SESSION['nombre'];
		if($_SESSION['rol'] == "admin"){
			$datos['direccion'] = "./menu.html";
		}
		else{
			$datos['direccion'] = "./menuBack.html";
		}
		$productosVenta = detallesVenta();
		foreach($productosVenta as $producto){
			if(($producto[0] != 1111111111)||($producto[0] != 1111111112)||($producto[0] != 1111111113)||($producto[0] != 1111111114) ){
					aumentarStockEn($producto[0], $producto[3]);
			}
		}
		cancelarCompra();
		if(existeProductoId(1111111111)){
			eliminarProducto(1111111111);
		}
		if(existeProductoId(1111111112)){
			eliminarProducto(1111111112);
		}
		if(existeProductoId(1111111113)){
			eliminarProducto(1111111113);
		}
		if(existeProductoId(1111111114)){
			eliminarProducto(1111111114);
		}
		renderizar('venta.html',$datos);
	}
	else{
		header('Location: ./ingresar.php');
	}
		
			

		

?>

	
	