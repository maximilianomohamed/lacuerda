<?php 

function consultarExistencia($user,$pass) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() ->prepare("SELECT * FROM usuario where username=? and password=?");
	$query->execute(array($user,$pass));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}

function devolverUser($user,$pass) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() ->prepare("SELECT username, rol, id FROM usuario where username=? and password=?");
	$query->execute(array($user,$pass));
	$conexion->desconectarBD();
	return ($query->fetchObject());
}

?>