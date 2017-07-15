<?php
function cargarRegistro($total, $fecha, $usuario, $tipoVenta ) {
    require_once('conexion.php');
    $conexion = new Conexion();
    $conexion->conectarBD();
    $query = $conexion -> getConexion() -> prepare("INSERT INTO venta (fecha, total, id_empleado, tipo_venta) VALUES (?, ?, ?, ?)");
    $query->execute(array($fecha, $total, $usuario, $tipoVenta ));
    $conexion->desconectarBD();
}

function obtenerVenta(){
    require_once('conexion.php');
    $conexion = new Conexion();
    $conexion->conectarBD();
    $query = $conexion -> getConexion() -> prepare("SELECT MAX(id) AS id FROM venta");
    $query->execute(array());
    $conexion->desconectarBD();
    return $query->fetchObject();
}

function obtenerProductos(){
    require_once('conexion.php');
    $conexion = new Conexion();
    $conexion->conectarBD();
    $query = $conexion -> getConexion() -> prepare("SELECT * FROM ventadeproducto");
    $query->execute(array());
    $conexion->desconectarBD();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function cargarDetalle($idVenta, $idProd, $cant, $precio){
    require_once('conexion.php');
    $conexion = new Conexion();
    $conexion->conectarBD();
    $query = $conexion -> getConexion() -> prepare("INSERT INTO detalle_venta (id_venta, id_producto, cantidad, precio) VALUES (?, ?, ?, ?)");
    $query->execute(array($idVenta, $idProd, $cant, $precio));
    $conexion->desconectarBD();
}

function ingresosDelMes($mes, $anio){
    require_once('conexion.php');
    $conexion = new Conexion();
    $conexion->conectarBD();
    $query = $conexion -> getConexion() -> prepare("SELECT * FROM venta WHERE MONTH(fecha) = ? AND YEAR(fecha) = ?");
    $query->execute(array($mes, $anio));
    $conexion->desconectarBD();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function ventasDelMes($mes, $anio){
    require_once('conexion.php');
    $conexion = new Conexion();
    $conexion->conectarBD();
    $query = $conexion -> getConexion() -> prepare("SELECT v.id, v.fecha, v.total, v.tipo_venta, u.username FROM venta v INNER JOIN usuario u ON(v.id_empleado = u.id) WHERE MONTH(fecha) = ? AND YEAR(fecha) = ?");
    $query->execute(array($mes, $anio));
    $conexion->desconectarBD();
    return $query->fetchAll();
}

function detallesCompletos($id){
    require_once('conexion.php');
    $conexion = new Conexion();
    $conexion->conectarBD();
    $query = $conexion -> getConexion() -> prepare("SELECT d.cantidad, d.precio, p.descripcionProducto AS descripcion FROM detalle_venta d INNER JOIN producto p ON(d.id_producto = p.idProducto) WHERE d.id_venta=?");
    $query->execute(array($id));
    $conexion->desconectarBD();
    return $query->fetchAll();
}