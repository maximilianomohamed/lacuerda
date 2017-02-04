<?php

	session_start();
	require_once('./configTwig.php');
	require_once('../model/abmProducto.php');


		$productos= detalleProductos();
		foreach ( $productos as $producto ) {
			if($producto->precioventa == 0){
				$preciodeventa = (($producto->precio)*($producto->ganancia))/100;
				modificarProducto($producto->idProducto,$producto->descripcionProducto,$producto->idMarca,$producto->ganancia,$producto->precio,$producto->precioventa);
			}
		}
		
		 

		$list['productos']= detalleProductos();
		if(isset($_GET['correctamente'])){
			$list['correctamente'] = true;
		}
		else{
		 	if(isset($_GET['error'])){
		 		$list['error'] = true;
		 	}
		}
		renderizar('productos.html',$list);
		
		

?>

	
	