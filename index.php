<?php

use Doctrine\Common\ClassLoader;

require_once("Doctrine/Common/ClassLoader.php");

require_once './Libraries/Twig/Autoloader.php';
Twig_Autoloader::register();

$classLoader = new ClassLoader("Pizza", "src");
$classLoader->register();

use Pizza\Business\GemeenteService;

$gemeente = GemeenteService::haalGemeenteOp("Bachte-Maria-Leerne");
$loader = new Twig_Loader_Filesystem("src/Pizza/Presentation");
$twig = new Twig_Environment($loader);
$view = $twig->render("gemeenteCode.twig", array( "gemeente" => $gemeente ));
print($view);