<?php 
//devuelve detalles de las reparaciones
function detalleReparaciones() {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> query("SELECT * FROM reparacion r INNER JOIN luthier l ON(l.idLuthier = r.idLuthier)");
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
function agregarReparacion($nota,$fecha,$nombre,$telefono,$email,$instrumento,$marcaModelo,$nroSerie, $senia) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("INSERT INTO reparacion (idLuthier, nota, estado, ubicacion, fecha, nombreCliente, telefonoCliente, emailCliente, instrumento, marcaModelo, nroSerie, precio, pagoLuthier, senia ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	$query->execute(array(1,$nota,"Ingresado","Local",$fecha, $nombre, $telefono, $email, $instrumento, $marcaModelo, $nroSerie, 0, "Impago", $senia));
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
function modificarReparacion($id, $nombre, $telefono, $email, $instrumento, $marcaModelo, $nroSerie, $precio, $luthier, $estado, $ubicacion, $notas, $senia, $manoDeObra, $insumos){
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("UPDATE reparacion SET idLuthier=?, nota=?, estado=?, ubicacion=?, nombreCliente=?, telefonoCliente=?, emailCliente=?, instrumento=?, marcaModelo=?, nroSerie=?, precio=?, insumos=?, manoDeObra=? WHERE idReparacion=?");
	$query->execute(array($luthier,$notas,$estado,$ubicacion,$nombre,$telefono,$email,$instrumento,$marcaModelo,$nroSerie,$precio,$insumos,$manoDeObra,$id));
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
	$query = $conexion -> getConexion() -> prepare("SELECT * FROM reparacion r INNER JOIN luthier l ON(r.idLuthier = l.idLuthier) WHERE r.idLuthier =?");
	$query->execute(array($id));
	$conexion->desconectarBD();
	return $query->fetchAll();
}

//devuelve la fecha de la reparacion pasada por parametro
function dameFecha($id) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT fecha FROM reparacion WHERE idReparacion=?");
	$query->execute(array($id));
	$res = $query -> fetchObject();
	$conexion->desconectarBD();
	return $res->fecha;
}

//devuelve el precio de la reparacion pasada por parametro
function damePrecioReparacion($id) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT precio FROM reparacion WHERE idReparacion=?");
	$query->execute(array($id));
	$res = $query -> fetchObject();
	$conexion->desconectarBD();
	return $res->precio;
}
function dameManoDeObraReparacion($id) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT manoDeObra FROM reparacion WHERE idReparacion=?");
	$query->execute(array($id));
	$res = $query -> fetchObject();
	$conexion->desconectarBD();
	return $res->manoDeObra;
}

//modifica el pago colocando solo pagado
function pagar($id) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("UPDATE reparacion  SET pagoLuthier=? WHERE idReparacion=?");
	$query->execute(array("Pagado", $id));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}
//modifica el estado de la reparacion y lo coloca en entregado
function entregado($id) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("UPDATE reparacion  SET estado=? WHERE idReparacion=?");
	$query->execute(array("Entregado", $id));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}
//devuelve id de la ultima reparación insertada
function ultimaReparacion() {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT MAX(idReparacion) as id FROM reparacion");
	$query->execute(array());
	$res = $query -> fetchObject();
	$conexion->desconectarBD();
	return $res->id;
}

   
?>