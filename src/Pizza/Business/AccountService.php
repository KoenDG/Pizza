<?php

namespace Pizza\Business;

use Pizza\Data;

class AccountService {
    
    public static function addAccount($id, $vnaam, $anaam, $email, $paswoord, $straat, $huisnr, $gemeente_id,$regdatum, $telefoon) {
        Data\AccountDAO::addAccount($id, $vnaam, $anaam, $email, $paswoord, $straat, $huisnr, $gemeente_id,$regdatum, $telefoon);
    }
    
    public static function processLogin($email) {
        $data = Data\AccountDAO::processLogin($email);
        return $data;
    }
    
    public static function getAccount($data) {
        $account = Data\AccountDAO::getAccount($data);
        return $account;
    }
    
    public static function getNumberOfAccounts() {
        $number = Data\AccountDAO::getNumberOfAccounts();
        return $number;
    }
    
}
