<?php
	session_start();
	require_once('../model/abmReparacion.php');
	require_once('./error.php');
	require_once('./configTwig.php');
	
			$nombre = $_POST["nombre"];
			$telefono = $_POST["telefono"];
			$email = $_POST["email"];
			$notas = $_POST["notas"];
			$instrumento = $_POST["instrumento"];
			$marcaModelo = $_POST["marcaModelo"];
			$senia = $_POST["senia"];
			$nroSerie = $_POST["nroSerie"];
			$fecha = date('y/m/j');
			
			//agrego la nueva reparacion como orden de compra
			agregarReparacion($notas,$fecha,$nombre,$telefono,$email,$instrumento,$marcaModelo,$nroSerie, $senia);
			//traigo la ultima reparación para poder ver el detalle e imprimirla
			$idUltima = ultimaReparacion();
			
			header('Location: ../controller/verDetalleOrden.php?id='.$idUltima);
			
			


?>