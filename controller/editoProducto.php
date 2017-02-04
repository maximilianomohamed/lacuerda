<?php

	require_once('../model/abmProducto.php');
	require_once('./configTwig.php');
			
			$id = $_POST["id"];
			$descripcion = $_POST["descripcion"];
			$marca = $_POST["marca"];
			$ganancia = $_POST["ganancia"];
			$precio = $_POST["precio"];
			$stock = $_POST["stock"];
			$preciodeventa = $precio+(($precio * $ganancia)/100);
			$preciodeventa = number_format($preciodeventa,2); 
			
				if (existeProductoId($id)){
					modificarProducto($id,$descripcion,$marca,$ganancia,$precio,$preciodeventa,$stock);
					header('Location: ../controller/listarProductos.php?correctamente');
				}
				else {
					header('Location: ../controller/listarProductos.php?error');
				}
			

?>