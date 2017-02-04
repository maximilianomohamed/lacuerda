<?php

	session_start();
	require_once('./configTwig.php');
	require_once('../model/abmVenta.php');
	require_once('../model/abmCaja.php');
	require_once('../model/abmProducto.php');
	require_once('../model/abmMovimientos.php');
	require_once('./funciones.php');
		$fecha = date('y/m/j');
		$mesActual = date("n");
		$anioActual = date("Y");
		$total = totalVenta();
		//si la caja esta abierta y es del dia de hoy concreto la compra
		if($total != 0){
				if(cajaAbierta($fecha)){
					if($total != 0){
						agregarACaja($total, $fecha);
					}
				}
				else{
					//ingresa una nueva compra con la fecha de hoy
			
					comenzarCaja($total, $fecha, $mesActual, $anioActual);
				}
				//realizar factura con los datos de la venta y retornarla para imprimir
				 $datos['fecha']= date('j/m/y');
				 $datos['detalles'] = detallesVenta();
				 $datos['total'] = totalVenta();
				//$datos['detalles'] = dameDatosReparacion($_GET['id']);
				//renderizar('PDFdetalleOrden.html',$datos);
				  $pagina = 'PDFfacturaEjemplo.html';
				  $imprime = "factura.pdf";
				  imprimirPdf($pagina, $imprime, $datos);
				cancelarCompra();
				if(existeProductoId(1111111111)){
					eliminarProducto(1111111111);
				}
				if(existeProductoId(1111111112)){
					eliminarProducto(1111111112);
				}
				if(existeProductoId(1111111113)){
					eliminarProducto(1111111113);
				}
				if(existeProductoId(1111111114)){
					eliminarProducto(1111111114);
						}
				$ingresos = total($mesActual, $anioActual);
				/*if(movimientosAbiertos($mesActual, $anioActual)){
					agregarIngresoMovimientos($ingresos, $mesActual, $anioActual);
				}
				else{
					abrirMovimientoIngreso($mesActual,$ingresos,0, $anioActual);
				}*/
		}
		if(isset($_SESSION['rol'])) {
		$datos['user'] = $_SESSION['nombre'];
		if($_SESSION['rol'] == "admin"){
			$datos['direccion'] = "./menu.html";
		}
		else{
			$datos['direccion'] = "./menuBack.html";
		}
		
		if(ventaSinfinalizar()){
			$detalles=detallesVenta();
			$total = totalVenta();
			$datos['detalles'] = $detalles;
			$datos['total'] = $total;
			$datos['venta'] = "encurso";
		
		}
		renderizar('venta.html',$datos);
	}
	else{
		header('Location: ./ingresar.php');
	}
		
		
		

?>

	