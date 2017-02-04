<?php
	session_start();
	require_once('../model/abmMovimientos.php');
	require_once('../model/abmGasto.php');
	require_once('../model/abmCaja.php');
	require_once('./error.php');
	require_once('./configTwig.php');
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	$fecha = date('y/m/j');
	$mes = date("n");
	$anio = date("Y");
	if(isset($_SESSION['rol'])) {
		$datos['user'] = $_SESSION['nombre'];
		if($_SESSION['rol'] == "admin"){
			$datos['direccion'] = "./menu.html";
		}
		else{
			$datos['direccion'] = "./menuBack.html";
		}
		if(($_POST["mes"] != "") && ($_POST["anio"] != "")){
			$mes = $_POST["mes"];
			$anio = $_POST["anio"];
		}
		else{
			$mes = date("n");
			$anio = date("Y");
		}

		$descripcion = $_POST["descripcion"];
		$gasto = $_POST["monto"];
		$tipo = $_POST["tipo"];
		$tipoGasto = $_POST["tipoGasto"];
		if($tipoGasto == "saleMes"){
			//agrega el gasto a los movimientos del mes si la plata sale del mes directamente
			if(movimientosAbiertos($mes, $anio)){
				agregarGastoMovimientos($gasto, $mes, $anio);
			}
			else{
				abrirMovimiento($mes,$gasto, 0, $anio);
			}
		}
		else{
		//sino la agrega como gasto y descuenta de la caja 
			if(cajaAbierta($fecha)){
					agregarGastoCaja($gasto, $fecha);
			}
			else{
				comenzarCaja(0, $gasto, $fecha, $mes, $anio);
			}
		}
		
		agregarGasto($descripcion, $gasto, $mes, $anio, $tipo, $tipoGasto, $fecha);
		if($tipoGasto == "saleMes"){
			header('Location: ../controller/movimientosMensuales.php?correctamente');
		}
		else{
			header('Location: ../controller/cajasDelMes.php?elMes='.$mes.'&elAnio='.$anio);
		}			
		
	}
	else{
		header('Location: ./ingresar.php');
	}


	
?>


