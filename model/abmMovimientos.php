<?php

//devuelve detalles de los movimientos
function detalleMovimientos() {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> query("SELECT * FROM movimientomensual");
	$conexion->desconectarBD();
	return $query->fetchAll();
}

function movimientosAbiertos($mes, $anio) {
	require_once('conexion.php');
	$conexion = new Conexion();

	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT * FROM movimientomensual WHERE mes = ? and anio = ?");
	$query->execute(array($mes,$anio));
	$res = $query -> fetch(PDO::FETCH_ASSOC);
	$conexion->desconectarBD();
	return $res;
}

function abrirMovimiento($mesActual,$ingreso,$gasto, $anioActual){
	require_once('conexion.php');
	$ganancia = $ingreso - $gasto;
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("INSERT INTO movimientomensual (mes, ingreso, egreso, ganancia, anio) VALUES (?,?,?,?,?)");
	$query->execute(array($mesActual,$ingreso,$gasto, $ganancia,$anioActual));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}

function agregarGastoMovimientos($gasto, $mes, $anio){
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("UPDATE movimientomensual SET egreso = egreso + ?, ganancia = ingreso - egreso WHERE mes=? and anio =?");
	$query->execute(array($gasto, $mes, $anio));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}

function agregarIngresoMovimientos($ingreso, $mes, $anio){
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("UPDATE movimientomensual SET ingreso = ?, ganancia = ingreso - egreso WHERE mes=? and anio =?");
	$query->execute(array($ingreso, $mes, $anio));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}
//resta el gasto pasado por parametro del mes pasado por parametro
function quitarGasto($gasto, $mes, $anio){
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("UPDATE movimientomensual SET ganancia = ganancia + ?, egreso = egreso - ?  WHERE mes=? and anio=?");
	$query->execute(array($gasto,$gasto,$mes,$anio));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}


?>