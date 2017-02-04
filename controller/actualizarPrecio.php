<?php


$precio= $_POST['precio'];
$ganancia= $_POST['ganancia'];


		$preciodeventa = $precio+(($precio * $ganancia)/100);
		$preciodeventa = number_format($preciodeventa,2); 
		echo json_encode($preciodeventa);

        
		
?>
