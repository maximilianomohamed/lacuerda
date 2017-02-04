<?php 
  function renderizar($view,$variable){
		require_once '../Twig-1.16.2/lib/Twig/Autoloader.php';
		Twig_Autoloader::register();
		$loader = new Twig_Loader_Filesystem('../view/');
		$twig = new Twig_Environment($loader, array());
		$template = $twig->loadTemplate( $view );
		$template->display($variable);
	}
 ?>