<?php
function agregarFotoN($idArticulo ,$tipo){
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("INSERT INTO imagenes (idArticulo, tipoArticulo) VALUES (?, ?)");
	$query->execute(array($idArticulo, $tipo));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}

function ultimaImagen(){
	require_once('conexion.php');
	$conexion=new Conexion();
	$conexion->conectarBD();
	$query=$conexion -> getConexion() -> prepare("SELECT MAX(idImagen) AS id FROM imagenes");
	$query->execute(array());
	$conexion->desconectarBD();
	return ($query -> fetchObject());
}

function actualizarDatosImagen($id, $nombre){
	require_once('conexion.php');
	$conexion=new Conexion();
	$conexion->conectarBD();
	$query=$conexion -> getConexion() -> prepare("UPDATE imagenes i SET nombreImagen=? WHERE i.idImagen=?");
	$query->execute(array($nombre, $id));
	$conexion->desconectarBD();
	return true;
}
?>