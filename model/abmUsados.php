<?php

function existeUsuario($nombre) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT * FROM usuario WHERE username=?");
	$query->execute(array($nombre));
	$res = $query->fetch(PDO::FETCH_ASSOC);
	$conexion->desconectarBD();
	return $res;
}

function agregarProductoUsado($descripcion,$precio,$marca,$ganancia,$precioventa) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("INSERT INTO usados (descripcion, precio, ganancia, idMarca, precioventa) VALUES (?, ?, ?, ?, ?)");
	$query->execute(array($descripcion, $precio, $ganancia, $marca, $precioventa));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}

function ultimoArticuloAgregado(){
	require_once('conexion.php');
	$conexion=new Conexion();
	$conexion->conectarBD();
	$query=$conexion -> getConexion() -> prepare("SELECT MAX(idUsado) AS id FROM usados");
	$query->execute(array());
	$conexion->desconectarBD();
	return ($query -> fetchObject());
}

function agregarFoto($idArticulo, $nombreImagen){
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("INSERT INTO imagenes (idArticulo, nombreImagen) VALUES (?, ?)");
	$query->execute(array($idArticulo, $nombreImagen));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}

?>