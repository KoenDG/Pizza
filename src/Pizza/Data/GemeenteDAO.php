<?php

namespace Pizza\Data;

use Pizza\Entities;
use Pizza\Exceptions;
use PDO;

class GemeenteDAO {

    public static function getAll() {
        $lijst = array();
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = 'select * from gemeentes';
        $resultSet = $dbh->query($sql);
        foreach ($resultSet as $rij) {
            $gemeente = new Entities\Gemeente($rij["id"], $rij["naam"], $rij["code"], $rij["leverbaar"]);
            array_push($lijst, $gemeente);
        }
        $dbh = null;
        return $lijst;
    }

    public static function getByName($naam) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = 'select * from gemeentes where naam = :naam';
        $sth = $dbh->prepare($sql);
        $sth->bindValue(':naam', $naam);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        
        $dbh = null;
        return $result;
    }
    
    public static function getAllByCode($code) {
        $lijst = array();
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = 'select * from gemeentes where code = :code';
        $sth = $dbh->prepare($sql);
        $sth->bindValue(':code', $code);
        
        $sth->execute();
        $resultSet = $sth->fetchAll(PDO::FETCH_ASSOC);
        
        //Onbestaande code zal geen resultaat opleveren. We stoppen de verdere uitvoering en geven meteen een fout terug.
        if(empty($resultSet)) {
            throw new Exceptions\FoutePostCodeException('Deze postcode geeft geen resultaten weer');
        }
        
        foreach ($resultSet as $rij) {
            $gemeente = new Entities\Gemeente($rij["id"], $rij["naam"], $rij["code"], $rij["leverbaar"]);
            //Als array opslaan. Anders moeten we later nog meer code schrijven om die te vertalen. JSON_encode werkt niet met objecten, vandaar.
            array_push($lijst, $gemeente);
        }
        $dbh = null;
        return $lijst;
    }

}
