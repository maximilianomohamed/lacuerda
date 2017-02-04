<?php

	session_start();
	require_once('./configTwig.php');
	
		$datos['lutheria'] = true;
		if(isset($_GET['maderas'])){
			renderizar('accesorios.html',$datos);
		}
		if(isset($_GET['herramientas'])){
			renderizar('accesorios.html',$datos);
		}
		if(isset($_GET['accesoriosLutheria'])){
			renderizar('accesorios.html',$datos);
		}



?>

	