<?php 
	function imprimirPdf($pagina, $imprime, $datos) {
		require_once("../dompdf-master/dompdf_config.inc.php");
		require_once '../Twig-1.16.2/lib/Twig/Autoloader.php';
		Twig_Autoloader::register();
		$loader = new Twig_Loader_Filesystem('../view/');
		$twig = new Twig_Environment($loader, array());
		$dompdf = new DOMPDF();
		$dompdf->set_paper("A4", "portrait");
		$html = $twig->render($pagina, $datos);
		$dompdf->load_html($html);
		ini_set("memory_limit","1024M");
		$dompdf->render();
		$dompdf->stream($imprime);
	}

 ?>
