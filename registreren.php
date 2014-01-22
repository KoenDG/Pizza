<?php

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
    $obf = new IdObfuscator();
    $result = Business\AccountService::getNumberOfAccounts();
    $number = $result[0] + 1;
    $id = $obf->encode($result[0] + 1);

    $options = array('cost' => 11);
    $pwData = password_hash($_POST["paswoord"], PASSWORD_BCRYPT, $options);

    $vnaam = $_POST["vnaam"];
    $anaam = $_POST["anaam"];
    $gemeente = Business\GemeenteService::getByCode($_POST["postcode"]);
    $gemeente_id = $gemeente[0]->getId();
    $email = $_POST["email"];
    $registratiedatum = date("Y-m-d H:i:s");
    $leveradres = $_POST["straat"];
    $huisNr = $_POST["huisnr"];
    $telefoon = $_POST["telefoon"];

    Business\AccountService::addAccount($vnaam, $anaam, $email, $paswoord, $straat, $huisnr, $postcode, $telefoon);
}


$loader = new Twig_Loader_Filesystem("src/Pizza/Presentation");
$twig = new Twig_Environment($loader);
$view = $twig->render("registratie.twig");
print($view);
