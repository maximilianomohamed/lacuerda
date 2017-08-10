<?php

	session_start();
	require_once('./configTwig.php');
	require_once('../model/abmUsados.php');
	require_once('../model/abmProductoNuevo.php');
	require_once('../model/abmCategoria.php');

		$datos['categorias'] = detalleCategoria();
		if(isset($_GET['accesorios'])){
			$datos['productosNuevos']=listaProductosNuevos('Accesorios');
			$datos['tipo'] = 'Accesorios';
			renderizar('accesorios.html',$datos);
		}
		if(isset($_GET['amplificadores'])){
			$datos['productosNuevos']=listaProductosNuevos('Amplificadores');
			$datos['tipo'] = 'Amplificadores';
			renderizar('accesorios.html',$datos);
		}
		if(isset($_GET['discos'])){
			$datos['productosNuevos']=listaProductosNuevos('Discos');
			$datos['tipo'] = 'Discos';
			renderizar('accesorios.html',$datos);
		}
		if(isset($_GET['instrumentos'])){
			$datos['productosNuevos']=listaProductosNuevos('Instrumentos');
			$datos['tipo'] = 'Instrumentos';
			renderizar('accesorios.html',$datos);
		}
		if(isset($_GET['libros'])){
			$datos['productosNuevos']=listaProductosNuevos('Libros');
			$datos['tipo'] = 'Libros';
			renderizar('accesorios.html',$datos);
		}
		if(isset($_GET['usados'])){
			$datos['categoria']='usados';
			$datos['usados']=listaUsados('usado');
			$datos['tipo'] = 'Usados';
			renderizar('accesorios.html',$datos);
		}
		if(isset($_GET['maderas'])){
			$datos['productosNuevos']=listaProductosNuevos('Maderas');
			$datos['tipo'] = 'Maderas';
			renderizar('accesorios.html',$datos);
		}
		if(isset($_GET['herramientas'])){
			$datos['productosNuevos']=listaProductosNuevos('Herramientas');
			$datos['tipo'] = 'Herramientas';
			renderizar('accesorios.html',$datos);
		}
		if(isset($_GET['accesorioslutheria'])){
			$datos['productosNuevos']=listaProductosNuevos('Accesorios lutheria');
			$datos['tipo'] = 'Accesorios Luthería';
			renderizar('accesorios.html',$datos);
		}
		


?>

	