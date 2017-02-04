<?php

//agrego gasto a la tabla de gastos asociandolo al mes en curso
function agregarGasto($descripcion, $gasto, $mes, $anio, $tipo, $tipoSalida, $fecha) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("INSERT INTO gasto (descripcion, monto, mes, anio, tipo, tipoSalida, fecha) VALUES (?,?,?,?,?,?,?)");
	$query->execute(array($descripcion, $gasto, $mes, $anio, $tipo, $tipoSalida, $fecha));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}

//devuelve detalles de los gastos
function detalleGastos($mes, $anio, $tipo) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT * FROM gasto WHERE mes = ? and anio=? and tipoSalida =?");
	$query->execute(array($mes, $anio, $tipo));
	$conexion->desconectarBD();
	return $query->fetchAll();
}
//Verifica si hay gastos realizados para ese mes 
function hayGastos($Mes, $anio) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT * FROM gasto WHERE mes=? and anio=? ");
	$query->execute(array($Mes, $anio));
	$res = $query->fetch(PDO::FETCH_ASSOC);
	$conexion->desconectarBD();
	return $res;
}

//devuelve el detalle del gasto y el monto del pasado por parametro
function dameDetalles($id) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT * FROM gasto WHERE idGasto=?");
	$query->execute(array($id));
	$res = $query -> fetchObject();
	$conexion->desconectarBD();
	return $res;
}

function modificarGasto($id, $descripcion, $monto, $tipo, $tipoSalida) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("UPDATE gasto SET descripcion= ?, monto=?, tipo=?, tipoSalida=? WHERE idGasto=?");
	$query->execute(array($descripcion,$monto,$tipo,$tipoSalida,$id));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}

function dameMonto($id) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT monto FROM gasto WHERE idGasto=?");
	$query->execute(array($id));
	$res = $query -> fetchObject();
	$conexion->desconectarBD();
	return $res->monto;
}

//eliminar un gasto
function eliminarGasto($id) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("DELETE FROM gasto WHERE idGasto=?");
	$query->execute(array($id));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}

?>