<?php

session_start();
if(!isset($_SESSION["user"])){
    //If we're logged in, why are we registering? Back to the home page.
    header("Location: login.php");
    die(0);
}

use Doctrine\Common\ClassLoader;

require_once('Doctrine/Common/ClassLoader.php');
$classLoader = new ClassLoader("Pizza", "src");
$classLoader->register();

require_once('Libraries/Twig/Autoloader.php');
Twig_Autoloader::register();

use Pizza\Business;

if (isset($_POST["best"])) {
    $amountCheese = $_POST["cheese"];
    $amountHawai = $_POST["hawai"];
    $amountMargherita = $_POST["margherita"];
    $amountPepperoni = $_POST["pepperoni"];
    
    $user = unserialize($_SESSION["user"]);
    
    $insertedId = Business\BestelService::addBestelling($user->getId());
    
    Business\BestelService::addDetails($insertedId, $amountCheese, $amountHawai, $amountMargherita, $amountPepperoni);
}

$pizzas = array(array(
    "name" => "cheese",
    "description" => "Pizza 4 kazen"
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
if(isset($_SESSION["user"])){
    $view = $twig->render("bestel.twig",array("pizzas" => $pizzas, "loggedin" => true));
} else {
    $view = $twig->render("bestel.twig",array("pizzas" => $pizzas));
}

print($view);