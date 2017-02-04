<?php 

//Verifica la existencia del coeficiente enviado como parametro
function existeCoeficiente($cantCuotas) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT * FROM coheficiente WHERE cantCuotas=? ");
	$query->execute(array($cantCuotas));
	$res = $query->fetch(PDO::FETCH_ASSOC);
	$conexion->desconectarBD();
	return $res;
}

function agregarCoeficiente($cantCuotas, $porcentaje) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("INSERT INTO coheficiente (cantCuotas, porcentaje) VALUES (?,?)");
	$query->execute(array($cantCuotas, $porcentaje));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}

function modificarCoeficiente($id, $cantCuotas, $porcentaje) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("UPDATE coheficiente  SET cantCuotas= ?, porcentaje= ? WHERE idCoheficiente=?");
	$query->execute(array($cantCuotas,$porcentaje,$id));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}

//devuelve detalles de los coeficientes
function detallesCoeficientes() {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> query("SELECT * FROM coheficiente");
	$conexion->desconectarBD();
	return $query->fetchAll();
}

//devuelve detalles del coheficiente enviado por parametro
function detallesDelCoeficiente($id) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT * FROM coheficiente WHERE idCoheficiente = ? ");
	$query->execute(array($id));
	$res = $query -> fetch(PDO::FETCH_ASSOC);
	$conexion->desconectarBD();
	return $res;
}
//devuelve detalles del coheficiente enviado por parametro
function porcentajeDeLaCuota($cantCuotas) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT porcentaje FROM coheficiente WHERE cantCuotas = ? ");
	$query->execute(array($cantCuotas));
	$res = $query -> fetchObject();
	$conexion->desconectarBD();
	return $res->porcentaje;
}
//eliminar un coeficiente
function eliminarCoeficiente($id) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("DELETE FROM coheficiente WHERE idCoheficiente=?");
	$query->execute(array($id));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}

   
?>