<?php

use Doctrine\Common\ClassLoader;

require_once("Doctrine/Common/ClassLoader.php");

$classLoader = new ClassLoader("Pizza", "src");
$classLoader->register();

use Pizza\Business\GemeenteService;
use Pizza\Exceptions;

try {
    $gemeentes = GemeenteService::getByCode($_POST["code"]);
    $lijst = array();
    foreach($gemeentes as $gemeente) {
        array_push($lijst, $gemeente->toArray());
    }
} catch (Exceptions\FoutePostCodeException $e) {
    $result = $e->getMessage();
    header('Content-Type: application/json');
    echo json_encode($result);
    die(0);
}


header('Content-Type: application/json');
$tmp = json_encode(array($gemeentes));
echo $tmp;