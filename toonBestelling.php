<?php

use Doctrine\Common\ClassLoader;

require_once("Doctrine/Common/ClassLoader.php");

require_once './Libraries/Twig/Autoloader.php';
Twig_Autoloader::register();

$classLoader = new ClassLoader("Pizza", "src");
$classLoader->register();

$Gemeenten = GemeenteService::toonAlleGemeenten();
$loader = new Twig_Loader_Filesystem("src/Pizza/Presentation");
$twig = new Twig_Environment($loader);
$view = $twig->render("bestellingen.twig", array( "pizzas" => $pizzas ));
print($view);