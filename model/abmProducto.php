<?php 

function existeProductoCodigo($codigo) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT * FROM producto WHERE codigoBarras=? ");
	$query->execute(array($codigo));
	$res = $query->fetch(PDO::FETCH_ASSOC);
	$conexion->desconectarBD();
	return $res;
}
function existeProducto($descripcion, $marca, $precio){
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT * FROM producto WHERE descripcionProducto=? and idMarca =? and precio =? ");
	$query->execute(array($descripcion, $marca, $precio));
	$res = $query->fetch(PDO::FETCH_ASSOC);
	$conexion->desconectarBD();
	return $res;
}
function existeProductoId($id){
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT * FROM producto WHERE idProducto =? ");
	$query->execute(array($id));
	$res = $query->fetch(PDO::FETCH_ASSOC);
	$conexion->desconectarBD();
	return $res;
}

function existeElProducto($descripcion){
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT * FROM producto WHERE descripcionProducto=?");
	$query->execute(array($descripcion));
	$res = $query->fetch(PDO::FETCH_ASSOC);
	$conexion->desconectarBD();
	return $res;
}
//devuelve el id del producto pasado por parametro
function dameId($codigoBarra) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT idProducto FROM producto WHERE codigoBarras=?");
	$query->execute(array($codigoBarra));
	$res = $query -> fetchObject();
	$conexion->desconectarBD();
	return $res->idProducto;
}
//devuelve el precio del producto enviado por parametro
function damePrecio($producto) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT precioventa FROM producto WHERE idProducto=?");
	$query->execute(array($producto));
	$res = $query -> fetchObject();
	$conexion->desconectarBD();
	return $res->precioventa;
}


function agregarProducto($descripcion,$precio,$marca,$ganancia,$precioventa,$codigoBarras,$stock) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("INSERT INTO producto (descripcionProducto, precio, idMarca, ganancia, precioventa, codigoBarras, stock) VALUES (?, ?, ?, ?, ?, ?, ?)");
	$query->execute(array($descripcion, $precio, $marca, $ganancia, $precioventa,$codigoBarras,$stock));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}
function agregarProductoId($codigobarra,$descripcion,$precio,$marca,$ganancia,$precioventa) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("INSERT INTO producto (idProducto, descripcionProducto, precio, idMarca, ganancia, precioventa) VALUES (?,?, ?, ?, ?, ?)");
	$query->execute(array($codigobarra,$descripcion,$precio,$marca,$ganancia,$precioventa));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}

function modificarProducto($codigobarra,$descripcion,$marca,$ganancia,$precio,$preciodeventa,$stock) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("UPDATE producto SET descripcionProducto= ?, precio= ?, idmarca=?, ganancia=?, precioventa=?, stock=? WHERE idProducto=?");
	$query->execute(array($descripcion,$precio,$marca,$ganancia,$preciodeventa,$stock,$codigobarra));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}
// modifica solamente el codigo del producto
function modificarCodigo($id,$codigoNuevo) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("UPDATE producto SET codigoBarras= ? WHERE idProducto=?");
	$query->execute(array($codigoNuevo, $id));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}


//devuelve detalles de los productos
function detalleProductos() {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> query("SELECT p.idProducto, p.descripcionProducto, p.precio, m.nombreMarca, p.ganancia, p.precioventa, p.idMarca, p.stock, p.codigoBarras FROM producto p INNER JOIN marca m ON(p.idMarca = m.idMarca)");
	$conexion->desconectarBD();
	return $query->fetchAll();
}

//eliminar un producto
function eliminarProducto($id) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("DELETE FROM producto WHERE idProducto=?");
	$query->execute(array($id));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}

//devuelve todos los datos del producto pasado por id
function dameDatos($id) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT p.idProducto, p.descripcionProducto, p.precio, p.ganancia, p.precioventa, m.nombreMarca, m.idMarca, p.stock FROM producto p INNER JOIN marca m ON(p.idMarca = m.idMarca) WHERE idProducto=?");
	$query->execute(array($id));
	$res = $query -> fetchObject();
	$conexion->desconectarBD();
	return $res;
}
//disminuyo stock en uno 
function disminuirStock($idProducto) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("UPDATE producto SET stock= (stock - 1) WHERE idProducto=?");
	$query->execute(array($idProducto));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}
//disminuyo stock la cantidad pasada por parametro
function disminuirStockEn($idProducto, $cantidad) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("UPDATE producto SET stock= (stock - ?) WHERE idProducto=?");
	$query->execute(array($cantidad, $idProducto));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}
//Aumenta el stock en uno 
function aumentarStock($idProducto) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("UPDATE producto SET stock= (stock + 1) WHERE idProducto=?");
	$query->execute(array($idProducto));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}
//Aumenta el stock de acuerdo a la cantidad pasada por parametro 
function aumentarStockEn($idProducto, $cantidad) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("UPDATE producto SET stock= (stock + ?) WHERE idProducto=?");
	$query->execute(array($cantidad,$idProducto));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}

//devuelve detalles de los productos con stock critico
function detalleProductosCriticos() {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> query("SELECT p.descripcionProducto, p.stock, p.codigoBarras, m.nombreMarca FROM producto p INNER JOIN marca m ON(m.idMarca = p.idMarca) WHERE stock < 5 ");
	$conexion->desconectarBD();
	return $query->fetchAll();
}
// se fija si hay productos con stock crítico 
function existeProductoCritico(){
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT * FROM producto WHERE stock < 5 ");
	$query->execute(array());
	$res = $query->fetch(PDO::FETCH_ASSOC);
	$conexion->desconectarBD();
	return $res;
}

?>