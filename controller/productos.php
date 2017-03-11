<?php

	session_start();
	require_once('./configTwig.php');
	require_once('../model/abmUsados.php');
	require_once('../model/abmProductoNuevo.php');
	require_once('../model/abmCategoria.php');

		$datos['categorias'] = detalleCategoria();
		if(isset($_GET['accesorios'])){
			$datos['productosNuevos']=listaProductosNuevos('Accesorios');
			renderizar('accesorios.html',$datos);
		}
		if(isset($_GET['amplificadores'])){
			$datos['productosNuevos']=listaProductosNuevos('Amplificadores');
			renderizar('accesorios.html',$datos);
		}
		if(isset($_GET['discos'])){
			$datos['productosNuevos']=listaProductosNuevos('Discos');
			renderizar('accesorios.html',$datos);
		}
		if(isset($_GET['instrumentos'])){
			$datos['productosNuevos']=listaProductosNuevos('Instrumentos');
			renderizar('accesorios.html',$datos);
		}
		if(isset($_GET['libros'])){
			$datos['productosNuevos']=listaProductosNuevos('Libros');
			renderizar('accesorios.html',$datos);
		}
		if(isset($_GET['usados'])){
			$datos['categoria']='usados';
			$datos['usados']=listaUsados('usado');
			renderizar('accesorios.html',$datos);
		}
		


?>

	