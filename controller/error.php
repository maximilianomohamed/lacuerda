<?php
require_once('./configTwig.php');

function errorPermisos() {
	$datos["error_titulo"] = 'Permiso denegado.';
	$datos["error_descripcion"] = 'Usted no tiene los permisos necesarios para realizar esta acción.';
	$datos["error_boton"] = 'Volver';
	$datos["error_link"] = 'history.go(-1);return true;';
	renderizar('error.html',$datos);
}


function errorPermisosSesion() {
	$datos["error_titulo"] = 'Permiso denegado.';
	$datos["error_descripcion"] = 'Debe haber iniciado sesión previamente.';
	$datos["error_boton"] = 'Ir al inicio';
	$datos["error_link"] = "location.href='../index.html'";
	renderizar('error.html',$datos);
}

function errorCamposVacios($link) {
	$datos["error_titulo"] = 'Campos vacíos.';
	$datos["error_descripcion"] = 'Debe completar todos los campos.';
	$datos["error_boton"] = 'Volver';
	$datos["error_link"] = $link;
	renderizar('error.html',$datos);
}



?>