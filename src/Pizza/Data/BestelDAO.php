<?php

namespace Pizza\Data;

use PDO;

class BestelDAO {
    
    public static function addBestelling($account_id) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $query = "INSERT INTO `bestellingen`(`account_id`, `afgehandeld`, `tBesteld`) VALUES (:account_id,0,:time)";
        $sth = $dbh->prepare($query);
        
        //Debugging
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sth->bindValue(':account_id', $account_id);
        $sth->bindValue(':time', date("Y-m-d H:i:s"));
        
        $sth->execute();
        
        return $dbh->lastInsertId();
    }
    
    public static function addDetails($bestelling_id,$amountCheese, $amountHawai, $amountMargherita, $amountPepperoni) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $query = "INSERT INTO `bestelling_details`(`Bestellingen_id`, `Pizzas_id`, `aantal`) VALUES ";
        
        //dit lijkt mij nodeloos ingewikkeld, maar ik zie geen andere manier
        if($amountCheese!=0){
            $query .= "(:bestelling_id,:kaas_id,:aantalKaas)";
        }
        if($amountHawai!=0){
            //Er wordt gekeken of de vorige toegevoegd is of niet. Zo ja, moet er een komma bij.
            if($amountCheese!=0) {
                $query .= ",";
            }
            $query .= "(:bestelling_id,:hawai_id,:aantalHawai)";
        }
        if($amountMargherita!=0){
            if($amountHawai!=0) {
                $query .= ",";
            }
            $query .= "(:bestelling_id,:margherita_id,:aantalMargherita)";
        }
        if($amountPepperoni!=0){
            if($amountMargherita!=0) {
                $query .= ",";
            }
            $query .= "(:bestelling_id,:pepperoni_id,:aantalPepperoni)";
        }
        
        
        $sth = $dbh->prepare($query);
        
        //Debugging
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //De hoeveelheid gebonden parameters moet altijd exact dezelfde zijn als de aantal gedefinieerde.
        $sth->bindValue(':bestelling_id', $bestelling_id);
        
        if($amountCheese!=0){
            $sth->bindValue(':kaas_id',1);
            $sth->bindValue(':aantalKaas',$amountCheese);
        }
        if($amountHawai!=0){
            $sth->bindValue(':hawai_id',2);
            $sth->bindValue(':aantalHawai',$amountHawai);
        }
        if($amountMargherita!=0){
            $sth->bindValue(':margherita_id',3);
            $sth->bindValue(':aantalMargherita',$amountMargherita);
        }
        if($amountPepperoni!=0){
            $sth->bindValue(':pepperoni_id',4);
            $sth->bindValue(':aantalPepperoni',$amountPepperoni);
        }
        
        $sth->execute();
        $dbh = null;
    }
    
}
