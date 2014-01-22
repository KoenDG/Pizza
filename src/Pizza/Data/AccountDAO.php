<?php

namespace Pizza\Data;
use PDO;

use Pizza\Entities;

class AccountDAO {
    
    public static function addAccount($vnaam,$anaam,$email,$paswoord,$straat,$huisnr,$postcode,$telefoon) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        
    }
    
    public static function getNumberOfAccounts() {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = 'select count(*) from accounts';
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch(PDO::FETCH_NUM);
        $dbh = null;
        return $rij;
    }
    
}
