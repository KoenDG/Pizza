<?php

session_start();
if(isset($_SESSION["user"])){
    //If we're logged in, why are we registering? Back to the home page.
    header("Location: bestel.php");
    die(0);
}


use Doctrine\Common\ClassLoader;

require_once('Doctrine/Common/ClassLoader.php');
$classLoader = new ClassLoader("Pizza", "src");
$classLoader->register();

require_once('Libraries/Twig/Autoloader.php');
Twig_Autoloader::register();

use Pizza\Business;

require_once 'Libraries/IDHash/IdObfuscator.php';
require_once './Libraries/PWHash/password.php';

if (isset($_POST["reg"])) {
    $result = Business\AccountService::getNumberOfAccounts();

    $obf = new IdObfuscator();
    $number = $result[0] + 1;
    $id = $obf->encode($result[0] + 1);

    $options = array('cost' => 11); //Meer duurt te lang.
    $pwData = password_hash($_POST["paswoord"], PASSWORD_BCRYPT, $options);

    $vnaam = $_POST["vnaam"];
    $anaam = $_POST["anaam"];

    $gemeente = Business\GemeenteService::getByCode($_POST["postcode"]);
    if(!is_null($gemeente)){
        //We hebben een resultaat
        $gemeente_id = $gemeente[0]->getId();
    } else {
        //De gemeente bestaat niet of is niet opgegeven. Hoe dan ook, herlaad pagina met error message.
        header("Location: registreren.php?err=gemeente");
        die(0);
    }
    $email = $_POST["email"] ;
    $registratiedatum = date("Y-m-d H:i:s");
    $leveradres = $_POST["straat"];
    $huisNr = $_POST["huisnr"];
    $telefoon = $_POST["telefoon"];
    
    
    try {
        Business\AccountService::addAccount($id, $vnaam, $anaam, $email, $pwData, $leveradres, $huisNr, $gemeente_id, $registratiedatum, $telefoon);
        header("Location: login.php");
        die(0);
    } catch (Exception $e) {
        echo 'Exception -> ';
        var_dump($e->getMessage());
    }
}

if(isset($_GET["err"])){
    if("gemeente" == $_GET["err"]) {
        $error = array("error" => "Gemeente bestaat niet of niet opgegeven.");
    }
}

$loader = new Twig_Loader_Filesystem("src/Pizza/Presentation");
$twig = new Twig_Environment($loader);
$view = $twig->render("registratie.twig", array("errors" => $error));
print($view);
