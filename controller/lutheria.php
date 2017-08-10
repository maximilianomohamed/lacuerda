<?php

	session_start();
	require_once('./configTwig.php');
	require_once('../model/abmUsados.php');
	require_once('../model/abmProductoNuevo.php');
	require_once('../model/abmCategoria.php');

	$datos['categorias'] = detalleCategoria();
	/*	if(isset($_GET['maderas'])){
				renderizar('accesorios.html',$datos);
			}
			if(isset($_GET['herramientas'])){
				renderizar('accesorios.html',$datos);
			}
			if(isset($_GET['accesoriosLutheria'])){
				renderizar('accesorios.html',$datos);
		}*/
		if(isset($_GET['discos'])){
			$datos['productosNuevos']=listaProductosNuevos('Maderas');
			renderizar('accesorios.html',$datos);
		}
		if(isset($_GET['instrumentos'])){
			$datos['productosNuevos']=listaProductosNuevos('Herramientas');
			renderizar('accesorios.html',$datos);
		}
		if(isset($_GET['libros'])){
			$datos['productosNuevos']=listaProductosNuevos('Accesorios lutheria');
			renderizar('accesorios.html',$datos);
		}


?>

	