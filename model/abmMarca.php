<?php 

//Verifica la existencia de la marca enviado por parametro
function existeMarca($nombre) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT * FROM marca WHERE nombreMarca=? ");
	$query->execute(array($nombre));
	$res = $query->fetch(PDO::FETCH_ASSOC);
	$conexion->desconectarBD();
	return $res;
}
//devuelve el nombde de la marca pasada por parametro 
function dameNombre($id) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT nombreMarca FROM marca WHERE idMarca=?");
	$query->execute(array($id));
	$res = $query -> fetchObject();
	$conexion->desconectarBD();
	return $res->nombreMarca;
}

function agregarMarca($nombre) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("INSERT INTO marca (nombreMarca) VALUES (?)");
	$query->execute(array($nombre));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}

function modificarMarca($id, $nombre) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("UPDATE marca  SET nombreMarca= ? WHERE idMarca=?");
	$query->execute(array($nombre,$id));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}

//devuelve detalles de las marcas
function detalleMarcas() {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> query("SELECT * FROM marca");
	$conexion->desconectarBD();
	return $query->fetchAll();
}
//eliminar una marca
function eliminarMarca($id) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("DELETE FROM marca WHERE idMarca=?");
	$query->execute(array($id));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}

   
?>