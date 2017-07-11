<?php
	function agregarProductoNuevo($descripcion, $tipo, $categoria, $nombre) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("INSERT INTO productonuevo (nombre, descripcion, idCategoria, idTipo) VALUES (?, ?, ?, ?)");
	$query->execute(array($nombre, $descripcion, $categoria, $tipo));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}

function ultimoArticuloAgregadoN(){
	require_once('conexion.php');
	$conexion=new Conexion();
	$conexion->conectarBD();
	$query=$conexion -> getConexion() -> prepare("SELECT MAX(id) AS id FROM productonuevo");
	$query->execute(array());
	$conexion->desconectarBD();
	return ($query -> fetchObject());
}

function listaProductosNuevos($tipoProducto){
	require_once('conexion.php');
	$conexion=new Conexion();
	$conexion -> conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT nombreImagen, idArticulo, c.nombre, p.nombre as nombreP, p.descripcion FROM productonuevo p INNER JOIN categoria c ON(p.idCategoria = c.id) INNER JOIN tipo t ON(p.idTipo = t.id) INNER JOIN imagenes i ON(p.id = i.idArticulo) WHERE ((i.tipoArticulo = ? )and(t.nombre = ?))");
	$query -> execute(array('nuevo', $tipoProducto));
	$conexion -> desconectarBD();
	return ($query -> fetchAll(PDO::FETCH_ASSOC));
}

?>