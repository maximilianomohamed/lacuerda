<?php

function comenzarCaja($ingreso, $egreso, $fecha, $mes, $anio) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$total= ($ingreso - $egreso);
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("INSERT INTO cajadiaria (ganancia, ingreso, egreso, fecha, mes, anio, estado) VALUES (?, ?, ?, ?, ?, ?, ?)");
	$query->execute(array($total, $ingreso, $egreso, $fecha, $mes, $anio, "Abierta"));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}

function agregarACaja($agregar, $fecha) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("UPDATE cajadiaria  SET ingreso= ingreso + ?, ganancia = ganancia +? WHERE fecha = ?");
	$query->execute(array($agregar, $agregar, $fecha));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}

function agregarGastoCaja($egreso, $fecha) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("UPDATE cajadiaria  SET egreso= egreso + ?, ganancia= ganancia - ? WHERE fecha = ?");
	$query->execute(array($egreso, $egreso, $fecha));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}

function cajaAbierta($fecha) {
	require_once('conexion.php');
	$conexion = new Conexion();

	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT * FROM cajadiaria WHERE fecha = ?");
	$query->execute(array($fecha));
	$res = $query -> fetch(PDO::FETCH_ASSOC);
	$conexion->desconectarBD();
	return $res;
}

//devuelve el valor de la caja actual
function cajaActual($fecha) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT ganancia FROM cajadiaria WHERE fecha = ?");
	$query->execute(array($fecha));
	$res = $query -> fetchObject();
	$conexion->desconectarBD();
	return $res->ganancia;
}

//devuelve detalles de la caja de el mes pasado por parametro
function detalleCajas($mes, $anio) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT * FROM cajadiaria WHERE mes = ? and anio=?");
	$query->execute(array($mes, $anio));
	$conexion->desconectarBD();
	return $query->fetchAll();
}

function hayCajas($mes, $anio) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT * FROM cajadiaria WHERE mes = ? and anio = ?");
	$query->execute(array($mes, $anio));
	$res = $query -> fetch(PDO::FETCH_ASSOC);
	$conexion->desconectarBD();
	return $res;
}

//devuelve el valor de las cajas del mes actual
function total($mes, $anio) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT SUM(ganancia) as ganancia FROM cajadiaria WHERE mes = ? and anio =?");
	$query->execute(array($mes, $anio));
	$res = $query -> fetchObject();
	$conexion->desconectarBD();
	$elTotal= number_format($res->ganancia,2, ",", ""); 
	return $elTotal;
}
//resta el gasto pasado por parametro del mes pasado por parametro
function quitarGastoCaja($gasto, $mes, $anio){
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("UPDATE cajadiaria SET ganancia = ganancia + ?, egreso = egreso - ?  WHERE mes=? and anio=?");
	$query->execute(array($gasto,$gasto,$mes,$anio));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}


?>