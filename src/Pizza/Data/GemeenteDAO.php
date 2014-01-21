<?php

namespace Pizza\Data;

use Pizza\Entities;
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

}
