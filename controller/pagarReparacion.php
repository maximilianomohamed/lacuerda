<?php

	session_start();
	require_once('../model/abmReparacion.php');
	require_once('../model/abmCaja.php');
	require_once('../model/abmMovimientos.php');
	require_once('../model/abmGasto.php');
	require_once('./configTwig.php');
		$fecha = date('y/m/j');
		$mesActual = date("n");
		$anioActual = date("Y");
		$idReparacion = $_POST["id"];
		$manoDeObra = $_POST["manoDeObra"];
		$tipoSalida = $_POST["tipoSalida"];
		$luthier = $_POST["luthier"];
		
		//colocar pagado en la tabla de la reparación
		pagar($idReparacion);
		
		//si sale de la caja descontarlo de la caja
		if($tipoSalida == "saleCaja"){
			//si la caja esta abierta y es del dia de hoy concreto la compra
			if(cajaAbierta($fecha)){
				// se le agrega el monto a la caja de la fecha pasada por parametro
				agregarGastoCaja($manoDeObra, $fecha);
			}
			else{
				//ingresa una nueva compra con la fecha de hoy
				comenzarCaja(0, $manoDeObra, $fecha, $mesActual, $anioActual);
			}
		}
		//sino se descuenta del mes 
		else{
			//$ingresos = total($mesActual, $anioActual);
			if(movimientosAbiertos($mesActual, $anioActual)){
				agregarGastoMovimientos($manoDeObra, $mesActual, $anioActual);
			}
			else{
				abrirMovimiento($mesActual,0,$manoDeObra, $anioActual);
			}
		}
		//agrego el movimiento a los detalles del gasto (mal llamado gasto)
		agregarGasto("Pago a ".$luthier, $manoDeObra, $mesActual, $anioActual, "Pago luthier", $tipoSalida, $fecha);	

		header('Location: ../controller/verDetalleOrden.php?id='.$idReparacion.'&correctamente');
			
			

?>


