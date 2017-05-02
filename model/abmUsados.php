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

function agregarProductoUsado($descripcion,$marca,$nombre, $precio) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("INSERT INTO usados (nombre, descripcion, idMarca, precio) VALUES (?, ?, ?, ?)");
	$query->execute(array($nombre, $descripcion, $marca, $precio));
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

function listaUsados($tipo){
	require_once('conexion.php');
	$conexion=new Conexion();
	$conexion -> conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT idArticulo, nombreImagen, nombre, descripcion, precio FROM usados u INNER JOIN imagenes i ON(u.idUsado = i.idArticulo) WHERE i.tipoArticulo=?");
	$query -> execute(array($tipo));
	$conexion -> desconectarBD();
	return ($query -> fetchAll(PDO::FETCH_ASSOC));
}

function detalleUsados(){
	require_once('conexion.php');
	$conexion=new Conexion();
	$conexion -> conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT * FROM usados u INNER JOIN marca m ON (u.idMarca = m.idMarca)");
	$query -> execute(array());
	$conexion -> desconectarBD();
	return ($query -> fetchAll(PDO::FETCH_ASSOC));
}
?>