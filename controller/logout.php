<?php
	session_start();
	if (isset($_SESSION['rol'])) {
		session_destroy();
	}
	header('Location: ./indexcontroller.php');	
?>