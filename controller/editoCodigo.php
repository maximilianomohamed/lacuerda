<?php

	require_once('../model/abmProducto.php');
	require_once('./configTwig.php');
	
			$actual = $_POST["actual"];
			$id = $_POST["id"];
			$codigonue = $_POST["codigonue"];
				if (!(existeProductoCodigo($codigonue))) {
					modificarCodigo($id, $codigonue);
					header('Location: ../controller/listarProductos.php?correctamente');
				}
				else {
					$datos["id"] = $id;
					$datos["codigo"] = $actual;
					header('Location: ../controller/editarCodigo.php?id='.$id.'&cod='.$actual.'&yaexiste');
				}
			

?>