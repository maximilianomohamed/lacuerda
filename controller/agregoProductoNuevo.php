<?php
	session_start();
	require_once('./configTwig.php');
	require_once('../model/abmProductoNuevo.php');
	require_once('../model/abmImagenes.php');

	$descripcion=$_POST['descripcion'];
	$tipo=$_POST['tipo'];
	$categoria=$_POST['categoria'];
	$nombre=$_POST['nombre'];
	agregarProductoNuevo($descripcion, $tipo, $categoria, $nombre);
	$articuloReciente=ultimoArticuloAgregadoN();
	$idArticulo=$articuloReciente->id;
	//imagen
	agregarFotoN($idArticulo, 'nuevo');
	$imagenReciente=ultimaImagen();
	$idImagenUlt=$imagenReciente->id;
	$extension = end((explode('.',$_FILES['foto']['name'])));
	$nomImg=$idImagenUlt.'.'.$extension;
	copy($_FILES['foto']['tmp_name'],"../images/portfolio/accesorios/".$nomImg);
	actualizarDatosImagen($idImagenUlt, $nomImg);
    //fin de la imagen
    
    header('Location: ../controller/articulos.php?correctamente');
?>