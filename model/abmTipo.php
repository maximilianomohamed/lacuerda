<?php
function detalleTipo() {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> query("SELECT * FROM tipo");
	$conexion->desconectarBD();
	return $query->fetchAll();
}
?>