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

?>