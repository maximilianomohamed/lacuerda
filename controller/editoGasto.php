<?php

	require_once('../model/abmGasto.php');
	require_once('../model/abmMovimientos.php');
	require_once('../model/abmCaja.php');
	require_once('./configTwig.php');
	
		$descripcion = $_POST["descripcion"];
		$monto = $_POST["monto"];
		$id = $_POST["id"];
		$mes = $_POST["mes"];
		$anio = $_POST["anio"];
		$tipo = $_POST["tipo"];
		$tipoGasto = $_POST["tipoGasto"];
		$fecha = $_POST["fecha"];
		//traigo el valor del gasto anterior
		$gastoAnterior = dameMonto($id);
		
		if( !($gastoAnterior == $monto)){
			if($tipoGasto == "saleMes"){
				quitarGasto($gastoAnterior,$mes, $anio);
				agregarGastoMovimientos($monto, $mes, $anio);
			}
			else{
				quitarGastoCaja($gastoAnterior, $mes, $anio);
				agregarGastoCaja($monto, $fecha);
			}
		}
		
		modificarGasto($id, $descripcion, $monto, $tipo, $tipoGasto);

		header('Location: ../controller/verGastos.php?correcto&mes='.$mes.'&anio='.$anio.'&tipo='.$tipoGasto);
			
			

?>