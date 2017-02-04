<?php

	session_start();
	require_once('../model/abmReparacion.php');
	require_once('../model/abmCaja.php');
	require_once('./configTwig.php');
		$fecha = date('y/m/j');
		$mesActual = date("n");
		$anioActual = date("Y");
		$idReparacion = $_GET["idReparacion"];
		$totalAPagar = $_GET["totalAPagar"];
		
		//colocar Entregado en la tabla de la reparación
		entregado($idReparacion);
		
		//si la caja es del dia de hoy concreto la entrega
		if(cajaAbierta($fecha)){
			// se le agrega el monto a la caja de la fecha pasada por parametro
			agregarACaja($totalAPagar, $fecha);
		}
		else{
			//ingresa el nuevo ingreso con la fecha de hoy
			comenzarCaja($totalAPagar, 0, $fecha, $mesActual, $anioActual);
		}
		

		header('Location: ../controller/verDetalleOrden.php?id='.$idReparacion.'&correctamente');
			
			

?>


