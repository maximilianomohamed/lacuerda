<?php 
//devuelve detalles de los pedidos
function detallePedidos() {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> query("SELECT * FROM pedido");
	$conexion->desconectarBD();
	return $query->fetchAll();
}
//relación con una reparación
function tieneReparacion($id) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT * FROM reparacion WHERE idLuthier=? ");
	$query->execute(array($id));
	$res = $query->fetch(PDO::FETCH_ASSOC);
	$conexion->desconectarBD();
	return $res;
}
//agrega una nueva orden de compra
function agregarReparacion($nota,$fecha,$nombre,$telefono,$email,$instrumento,$marcaModelo,$nroSerie) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("INSERT INTO reparacion (idLuthier, nota, estado, ubicacion, fecha, nombreCliente, telefonoCliente, emailCliente, instrumento, marcaModelo, nroSerie, precio, pagoLuthier) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
	$query->execute(array(1,$nota,"Ingresado","Local",$fecha, $nombre, $telefono, $email, $instrumento, $marcaModelo, $nroSerie, 0, "Impago"));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}

//eliminar una reparacion
function eliminarReparacion($id) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("DELETE FROM reparacion WHERE idReparacion=?");
	$query->execute(array($id));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}
//devuelve detalles de la reparacion enviada por parametro

function dameDatosReparacion($id) {
	require_once('conexion.php');
	$conexion = new Conexion();

	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT * FROM reparacion r INNER JOIN luthier l ON(l.idLuthier = r.idLuthier) WHERE r.idReparacion=?");
	$query->execute(array($id));
	$res = $query -> fetch(PDO::FETCH_ASSOC);
	$conexion->desconectarBD();
	return $res;
}
//modifico una reparacion
function modificarReparacion($id, $nombre, $telefono, $email, $instrumento, $marcaModelo, $nroSerie, $precio, $luthier, $estado, $ubicacion, $notas, $pagoLuthier) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("UPDATE reparacion  SET idLuthier= ?, nota=?, estado=?, ubicacion=?, nombreCliente=?, telefonoCliente=?, emailCliente=?, instrumento=?, marcaModelo=?, nroSerie=?, precio=?, pagoLuthier=? WHERE idReparacion=?");
	$query->execute(array($luthier,$notas,$estado,$ubicacion,$nombre, $telefono, $email, $instrumento, $marcaModelo, $nroSerie, $precio, $pagoLuthier, $id));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}

//devuelve las reparaciones del luthier pasado por parametro 

function dameReparacionesDe($id) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT * FROM reparacion WHERE idLuthier =?");
	$query->execute(array($id));
	$conexion->desconectarBD();
	return $query->fetchAll();
}



   
?>