<?php

namespace Pizza\Business;

use Pizza\Data;

class AccountService {
    
    public static function addAccount($vnaam, $anaam, $email, $paswoord, $straat, $huisnr, $postcode, $telefoon) {
        Data\AccountDAO::addAccount($vnaam, $anaam, $email, $paswoord, $straat, $huisnr, $postcode, $telefoon);
    }
    
    public static function getNumberOfAccounts() {
        $number = Data\AccountDAO::getNumberOfAccounts();
        return $number;
    }
    
}
