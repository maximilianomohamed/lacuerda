<?php
function detalleCategoria(){
	require_once('conexion.php');
	$conexion=new Conexion();
	$conexion -> conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT * FROM categoria");
	$query -> execute(array());
	$conexion -> desconectarBD();
	return ($query -> fetchAll(PDO::FETCH_ASSOC));
}
?>