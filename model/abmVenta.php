<?php 

//Verifica la existencia de una venta sin finalizar
function ventaSinfinalizar() {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT * FROM ventadeproducto");
	$query->execute(array());
	$res = $query->fetch(PDO::FETCH_ASSOC);
	$conexion->desconectarBD();
	return $res;
}
//Devuelve la existencia del producto en la venta
function existeProductoVenta($idproducto) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT * FROM ventadeproducto WHERE idProducto=?");
	$query->execute(array($idproducto));
	$res = $query -> fetch(PDO::FETCH_ASSOC);
	$conexion->desconectarBD();
	return $res;
}
//Devuelvo el subtotal del producto
function dameSubtotal($idProducto) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT subtotal FROM ventadeproducto WHERE idProducto= ? ");
	$query->execute(array($idProducto));
	$res = $query -> fetchObject();
	$conexion->desconectarBD();
	$elSubtotal= number_format($res->subtotal,1); 
	return $elSubtotal;
}

//Modifico la cantidad del producto en la venta 
function modificoProductoVenta($idproducto, $cantidad, $precio) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$subtotal= $cantidad * $precio; 
	$query = $conexion -> getConexion() -> prepare("UPDATE ventadeproducto  SET cantidad= cantidad + ? , subtotal = subtotal + ? WHERE idProducto=?");
	$query->execute(array($cantidad, $subtotal ,$idproducto));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}

// Agrego un nuevo producto a la venta
function agregarProductoVenta($idproducto, $cantidad, $precio) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$subtotal= $cantidad * $precio; 
	$query = $conexion -> getConexion() -> prepare("INSERT INTO ventadeproducto (idProducto, cantidad, precio, subtotal) VALUES (?, ?, ?, ?)");
	$query->execute(array($idproducto, $cantidad, $precio, $subtotal));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}


//devuelve detales de la venta
function detallesVenta() {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> query("SELECT p.idProducto, p.descripcionProducto, m.nombreMarca, v.cantidad, v.precio, v.subtotal FROM ventadeproducto v INNER JOIN producto p ON(p.idProducto = v.idProducto) INNER JOIN marca m ON(m.idMarca=p.idMarca)");
	$conexion->desconectarBD();
	return $query->fetchAll();
}

//devuelve el total actual de la compra
function totalVenta() {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT SUM(subtotal) as total FROM ventadeproducto ");
	$query->execute(array());
	$res = $query -> fetchObject();
	$conexion->desconectarBD();
//	$elTotal= number_format($res->total,2); 
	return $res->total;
}


function cancelarCompra() {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("DELETE FROM ventadeproducto");
	$query->execute(array());
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}

function eliminarProductoVenta($idProducto) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("DELETE FROM ventadeproducto WHERE idProducto = ?");
	$query->execute(array($idProducto));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}
//devuelve la cantidad del producto que hay en esa compra 
function cantidadVendido($idProducto) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT cantidad FROM ventadeproducto WHERE idProducto=?");
	$query->execute(array($idProducto));
	$res = $query -> fetchObject();
	$conexion->desconectarBD();
	return $res->cantidad;
}
//disminuye en uno la cantidad de la venta
function disminuirEnUnoCantidad($idProducto) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("UPDATE ventadeproducto  SET cantidad= cantidad - 1 , subtotal = cantidad * precio WHERE idProducto=?");
	$query->execute(array($idProducto));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}
//aumenta el precio de cada uno de los productos de la venta en el porcentaje pasado por parametro
function aumentaEn($porcentaje) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("UPDATE ventadeproducto  SET precio = precio + ((precio * ?)/100), subtotal = cantidad * precio WHERE precio > 0");
	$query->execute(array($porcentaje));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}


?>