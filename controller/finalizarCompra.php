<?php

	session_start();
	require_once('./configTwig.php');
	require_once('../model/abmVenta.php');
	require_once('../model/abmCoeficientes.php');
	require_once('../model/abmCaja.php');
	require_once('../model/abmProducto.php');
	require_once('../model/abmTarjeta.php');
        require_once('../model/abmRegistro.php');
		date_default_timezone_set('America/Argentina/Buenos_Aires');
		$fecha = date('y/m/j');
		$mesActual = date("n");
		$anioActual = date("Y");
		$total = totalVenta();
                $usuario=$_SESSION['id'];
			//si la caja esta abierta y es del dia de hoy concreto la compra
		
			if($_POST['venta'] == "Contado" or $_POST['venta'] == "Cuenta Corriente" ){
				
                                //Empieza el registro                                
                                $tipo='efectivo';
                                cargarRegistro($total, $fecha, $usuario, $tipo );
                                $ultimaVenta=obtenerVenta();
                                $ultVenta=$ultimaVenta->id;
                                $productos=obtenerProductos();
                                foreach ($productos as $prod){
                                    cargarDetalle($ultVenta, $prod['idProducto'], $prod['cantidad'], $prod['precio']);
                                }
                                
				if(cajaAbierta($fecha)){
					agregarACaja($total, $fecha);
				}
				else{
					//ingresa una nueva compra con la fecha de hoy
					comenzarCaja($total, 0, $fecha, $mesActual, $anioActual);
				}
				//ACA GUARDARÏA LOS PRODUCTOS PARA MANTENER UN CONTROL DEL DETALLE DE VENTAS.
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
					
			}
			else{
				
                            $tipo='tarjeta';
                            cargarRegistro($total, $fecha, $usuario, $tipo );
                            $ultimaVenta=obtenerVenta();
                            $ultVenta=$ultimaVenta->id;
                            $productos=obtenerProductos();
                            foreach ($productos as $prod){
                                cargarDetalle($ultVenta, $prod['idProducto'], $prod['cantidad'], $prod['precio']);
                            }
                            
                            //es una venta realizada por tarjeta entonces la sumo a la tarjeta por separado.
                            $cantCuotas = $_POST['venta'];
                            $porcentaje = porcentajeDeLaCuota($cantCuotas);
                            $total = ($total*$porcentaje/100)+ $total;
                            agregarATarjeta($total, $fecha, $mesActual, $anioActual,$cantCuotas);
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

	
	