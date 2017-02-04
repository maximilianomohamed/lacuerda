<?php 
	session_start();

	require_once('../model/abmGasto.php');
	require_once('../model/abmMovimientos.php');
	$id=$_GET["id"];
	$mes=$_GET["mes"];
	$anio=$_GET["anio"];
	$tipo=$_GET["tipo"]
;	$gasto = dameMonto($id);
	//elimino el gasto de la tabla gastos
	eliminarGasto($id);
	//si viene de la caja lo resto de ella sino de los gastos 
	if($tipo == "saleMes"){
		//resto el gasto de los movimientos
		quitarGasto($gasto, $mes, $anio);
	}
	else{
		quitarGastoCaja($gasto, $mes, $anio);
	}
	header('Location: ../controller/verGastos.php?correcto&mes='.$mes.'&anio='.$anio.'&tipo='.$tipo);

	
?>