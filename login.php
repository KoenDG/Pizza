<?php

session_start();
if(!isset($_COOKIE["PHPSESSID"])) {
    //We zijn op deze pagina gekomen vanuit een niet-ingelogde status.
} elseif($_COOKIE["PHPSESSID"] != session_id()) {
    //Als de sessie niet meer klopt met die op de server, loggen we uit.
    require("logout.php");
}

if(isset($_SESSION["user"])) {
    //We are logged in. No reason to be here.
    header('Location: bestel.php');
    die(0);
}

use Doctrine\Common\ClassLoader;

require_once('Doctrine/Common/ClassLoader.php');
$classLoader = new ClassLoader("Pizza", "src");
$classLoader->register();

require_once('Libraries/Twig/Autoloader.php');
Twig_Autoloader::register();

use Pizza\Business;

require_once './Libraries/PWHash/password.php';

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $pw = $_POST["paswoord"];

    try {
        $data = Business\AccountService::processLogin($email);
        if (password_verify($pw, $data["pw"])) {
            $account = Business\AccountService::getAccount($data);
            $_SESSION["user"] = serialize($account);
        } else {
            throw new Exception("Paswoord fout");
        }
    } catch (Exception $e) {
        echo 'Exception -> ';
        var_dump($e->getMessage());
    }
}


$loader = new Twig_Loader_Filesystem("src/Pizza/Presentation");
$twig = new Twig_Environment($loader);
$view = $twig->render("login.twig");
print($view);
