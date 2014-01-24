<?php

namespace Pizza\Data;

use PDO;
use Exception;
use Pizza\Entities;

class AccountDAO {

    public static function addAccount($id, $vnaam, $anaam, $email, $paswoord, $straat, $huisnr, $gemeente_id, $regdatum, $telefoon) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $query = "INSERT INTO `accounts`(`id`, `gemeente_id`, `email`, `pwhash`, `registratiedatum`, `vnaam`, `anaam`, `leveradres`, `huisNr`, `telefoon`) VALUES (:id,:gemeente_id,:email,hex(:pwhash),:registratiedatum,:vnaam,:anaam,:leveradres,:huisNr,:telefoon)";
        $sth = $dbh->prepare($query);

        //Debugging
        //$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        

        $sth->bindValue(':id', $id, PDO::PARAM_STR);
        $sth->bindValue(':gemeente_id', $gemeente_id, PDO::PARAM_INT);
        $sth->bindValue(':email', $email, PDO::PARAM_STR);
        $sth->bindValue(':pwhash', $paswoord);
        $sth->bindValue(':registratiedatum', $regdatum);
        $sth->bindValue(':vnaam', $vnaam, PDO::PARAM_STR);
        $sth->bindValue(':anaam', $anaam, PDO::PARAM_STR);
        $sth->bindValue(':leveradres', $straat, PDO::PARAM_STR);
        $sth->bindValue(':huisNr', $huisnr, PDO::PARAM_STR);
        $sth->bindValue(':telefoon', $telefoon, PDO::PARAM_STR);

        $sth->execute();
    }
    
    public static function processLogin($email) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        //Eerst het record ophalen, dan het pw vergelijken.
        $query = 'select unhex(pwhash) as pw, accounts_public.* from accounts, accounts_public where accounts.email = :email';
        
        $sth = $dbh->prepare($query);
        
        
        //Debugging
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sth->bindValue(':email', $email, PDO::PARAM_STR);
        
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if($result == false) {
            throw new Exception("Email niet teruggevonden");
        }
        
        return $result;
    }

    public static function getNumberOfAccounts() {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = 'select count(*) from accounts';
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch(PDO::FETCH_NUM);
        $dbh = null;
        return $rij;
    }
    
    public static function getAccount($data) {
        $account = new Entities\Account_public($data["id"], $data["gemeente_id"], $data["vnaam"], $data["anaam"], $data["leveradres"], $data["huisNr"], $data["telefoon"]);
        return $account;
    }

}
