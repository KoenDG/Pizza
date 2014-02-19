<?php

session_start();
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

if(isset($_GET["err"])){
    if("login" == $_GET["err"]) {
        $error = array("error" => "Login niet herkend.");
    }
}

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $pw = $_POST["paswoord"];
    
    if(empty($email) || empty($pw)) {
        header("Location: login.php?err=login");
        die(0);
    }

    try {
        $data = Business\AccountService::processLogin($email);
        if (password_verify($pw, $data["pw"])) {
            $account = Business\AccountService::getAccount($data);
            $_SESSION["user"] = serialize($account);
            header("Location: bestel.php");
            die(0);
        } else {
            throw new Exception("Paswoord fout");
        }
    } catch (Exception $e) {
        $error = array("error"=>$e->getMessage());
    }
}


$loader = new Twig_Loader_Filesystem("src/Pizza/Presentation");
$twig = new Twig_Environment($loader);
if(empty($error)){
    $view = $twig->render("login.twig");
} else {
    $view = $twig->render("login.twig", array("errors" => $error));
}
print($view);
