<?php

session_start();
use Doctrine\Common\ClassLoader;

require_once('Doctrine/Common/ClassLoader.php');
$classLoader = new ClassLoader("Pizza", "src");
$classLoader->register();

require_once('Libraries/Twig/Autoloader.php');
Twig_Autoloader::register();

$pizzas = array(array(
    "name" => "cheese",
    "description" => "4 kazen pizza"
),array(
    "name" => "hawai",
    "description" => "Pizza hawai"
),array(
    "name" => "margherita",
    "description" => "Pizza Margherita"
),array(
    "name" => "pepperoni",
    "description" => "Pizza Pepperoni"
));

$loader = new Twig_Loader_Filesystem("src/Pizza/Presentation");
$twig = new Twig_Environment($loader);
$view = $twig->render("bestel.twig",array("pizzas" => $pizzas));
print($view);