<?php

	session_start();
	require_once('./configTwig.php');
	
		$datos['producto'] = true;
		if(isset($_GET['accesorios'])){
			renderizar('accesorios.html',$datos);
		}
		if(isset($_GET['amplificadores'])){
			renderizar('accesorios.html',$datos);
		}
		if(isset($_GET['discos'])){
			renderizar('accesorios.html',$datos);
		}
		if(isset($_GET['instrumentos'])){
			renderizar('accesorios.html',$datos);
		}
		if(isset($_GET['libros'])){
			renderizar('accesorios.html',$datos);
		}
		


?>

	