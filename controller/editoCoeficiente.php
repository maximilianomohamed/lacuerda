<?php

	require_once('../model/abmCoeficientes.php');
	require_once('./configTwig.php');
	
			$cantCuotas = $_POST["cantCuotas"];
			$porcentaje = $_POST["porcentaje"];
			$id = $_POST["id"];
				
			modificarCoeficiente($id, $cantCuotas, $porcentaje);	
			header('Location: ../controller/coeficientes.php?correctamente');
			
				
			

?>