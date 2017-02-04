<?php

	require_once('../model/abmReparacion.php');
	require_once('./configTwig.php');
			
			$id = $_POST["id"];
			$nombre = $_POST["nombre"];
			$telefono = $_POST["telefono"];
			$email = $_POST["email"];
			$instrumento = $_POST["instrumento"];
			$marcaModelo = $_POST["marcaModelo"];
			$nroSerie = $_POST["nroSerie"];
			$luthier = $_POST["luthier"];
			$estado = $_POST["estado"];
			$ubicacion = $_POST["ubicacion"];
			$notas = $_POST["notas"];
			$manoDeObra = $_POST["manoDeObra"];
			$insumos = $_POST["insumos"];
			$precio = $manoDeObra + $insumos + ($manoDeObra*0.33);

			modificarReparacion($id, $nombre, $telefono, $email, $instrumento, $marcaModelo, $nroSerie, $precio, $luthier, $estado, $ubicacion, $notas, $senia, $manoDeObra, $insumos);
			

			header('Location: ../controller/reparaciones.php?correctamente');
				
			

?>