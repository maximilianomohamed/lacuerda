<?php 

function existeUsuario($nombre) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT * FROM usuario WHERE username=?");
	$query->execute(array($nombre));
	$res = $query->fetch(PDO::FETCH_ASSOC);
	$conexion->desconectarBD();
	return $res;
}

function existeUsuarioAdmin($nombre, $rol) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT * FROM usuario WHERE username=? and rol=?");
	$query->execute(array($nombre, $rol));
	$res = $query->fetch(PDO::FETCH_ASSOC);
	$conexion->desconectarBD();
	return $res;
}

function agregarUsuario($nombre, $contrasenia,$rol) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("INSERT INTO usuario (username, password,rol) VALUES (?, ?, ?)");
	$query->execute(array($nombre, $contrasenia, $rol));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}


function modificarUsuario($nombre, $contraseña,$id) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("UPDATE usuario  SET username=?, password=?  WHERE id=?");
	$query->execute(array($nombre, $contraseña, $id));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}

function modificarUsuarioAdmin($nombre, $rol, $id) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("UPDATE usuario  SET username=?, rol=? WHERE id=?");
	$query->execute(array($nombre, $rol,$id));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}

function buscarUsuario($id) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT * FROM usuario WHERE id=?");
	$query->execute(array($id));
	$res = $query -> fetch(PDO::FETCH_ASSOC);
	$conexion->desconectarBD();
	return $res;
}

function eliminarUsuario($id) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare(" DELETE FROM usuario WHERE id=?");
	$query->execute(array($id));
	$ok = false;
	if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
		$ok = true;
	}
	$conexion->desconectarBD();
	return $ok;
}

//devuelve detalles de los usuarios
function detalleUsuarios() {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> query("SELECT id, username, rol FROM usuario");
	$conexion->desconectarBD();
	return $query->fetchAll();
}

//devuelve detalles del usuario pasado por parametro
function dameDatos($id) {
	require_once('conexion.php');
	$conexion = new Conexion();
	$conexion->conectarBD();
	$query = $conexion -> getConexion() -> prepare("SELECT * FROM usuario WHERE id=?");
	$query->execute(array($id));
	$res = $query -> fetchObject();
	$conexion->desconectarBD();
	return $res;
}
?>