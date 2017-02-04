<?php
//Agrega a la tarjeta una nueva venta
function agregarATarjeta($total, $fecha, $mesActual, $anioActual,$cantCuotas){
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("INSERT INTO movimientostarjeta (monto, fecha, anio, mes, cantCuotas) VALUES (?,?,?,?,?)");
	$query->execute(array($total, $fecha, $anioActual, $mesActual, $cantCuotas));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}
//devuelve detalles de los movimientos
function detalleMovimientosTarjeta() {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> query("SELECT * FROM movimientostarjeta");
	$conexion->desconectarBD();
	return $query->fetchAll();
}

//eliminar un movimiento
function eliminarMoviTarjeta($id) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("DELETE FROM movimientostarjeta WHERE idMovTarj=?");
	$query->execute(array($id));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}

?>