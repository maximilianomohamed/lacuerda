<?php

	session_start();
	require_once('./configTwig.php');
	$dato['contacto'] = true;
	renderizar('contacto.html',$dato);
		

?>

	
	