<?php

	session_start();
	require_once('./configTwig.php');
	require_once('../model/abmVenta.php');
	require_once('../model/abmProducto.php');
	require_once('../model/abmCoeficientes.php');
	if(isset($_SESSION['rol'])) {
		$datos['user'] = $_SESSION['nombre'];
		if($_SESSION['rol'] == "admin"){
			$datos['direccion'] = "./menu.html";
		}
		else{
			$datos['direccion'] = "./menuBack.html";
		}
		
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			//me fijo la cantidad de la venta, si es mayor a uno entonces elimino solo uno de la compra
			if(cantidadVendido($id) == 1 ){
				eliminarProductoVenta($id);
			}
			else{
				disminuirEnUnoCantidad($id);
			}
			aumentarStock($id);
			if($id == 1111111111){
				eliminarProducto(1111111111);
			}
			if($id == 1111111112){
				eliminarProducto(1111111112);
			}
			if($id == 1111111113){
				eliminarProducto(1111111113);
			}
			if($id == 1111111114){
				eliminarProducto(1111111114);
			}
		}
	
		if(ventaSinfinalizar()){
			$detalles=detallesVenta();
			$total = totalVenta();
			$datos['detalles'] = $detalles;
			$datos['total'] = $total;
			$datos['venta'] = "encurso";
			$datos['cuotas'] = detallesCoeficientes();
		
		}
		renderizar('venta.html',$datos);
	}
	else{
		header('Location: ./ingresar.php');
	}
		
		
		

?>

	
	