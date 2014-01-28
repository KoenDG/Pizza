<?php

namespace Pizza\Business;

use Pizza\Data;

class BestelService {
    
    public static function addBestelling($account_id){
        $insertId = Data\BestelDAO::addBestelling($account_id);
        return $insertId;
    }
    
    public static function addDetails($bestelling_id,$amountCheese, $amountHawai, $amountMargherita, $amountPepperoni) {
        Data\BestelDAO::addDetails($bestelling_id,$amountCheese, $amountHawai, $amountMargherita, $amountPepperoni);
    }
    
}
