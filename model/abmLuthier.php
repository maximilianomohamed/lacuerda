<?php 
//devuelve detalles de luthiers
function detalleLuthiers() {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> query("SELECT * FROM luthier");
	$conexion->desconectarBD();
	return $query->fetchAll();
}
//Verifica la existencia del luthier enviado por parametro
function existeLuthier($nombre) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT * FROM luthier WHERE nombreLuthier=? ");
	$query->execute(array($nombre));
	$res = $query->fetch(PDO::FETCH_ASSOC);
	$conexion->desconectarBD();
	return $res;
}

function agregarLuthier($nombre) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("INSERT INTO luthier (nombreLuthier) VALUES (?)");
	$query->execute(array($nombre));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}
//devuelve el nombde del luthier pasado por parametro
function dameNombreLuthier($id) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT nombreLuthier FROM luthier WHERE idLuthier=?");
	$query->execute(array($id));
	$res = $query -> fetchObject();
	$conexion->desconectarBD();
	return $res->nombreLuthier;
}


function modificarLuthier($id, $nombre) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("UPDATE luthier  SET nombreLuthier= ? WHERE idLuthier=?");
	$query->execute(array($nombre,$id));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}



//eliminar un luthier
function eliminarLuthier($id) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("DELETE FROM luthier WHERE idLuthier=?");
	$query->execute(array($id));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}

   
?>