<?php

namespace Pizza\Business;

use Pizza\Data;

class GemeenteService {
    
    public static function toonAlleGemeenten() {
        $lijst = Data\GemeenteDAO::getAll();
        return $lijst;
    }
    
    public static function getByName($naam) {
        $gemeente = Data\GemeenteDAO::getByName($naam);
        return $gemeente;
    }
    
    public static function getByCode($code) {
        //Return is een array, omdat meerdere gemeentes bij éénzelfde postcode passen.
        $lijst = Data\GemeenteDAO::getAllByCode($code);
        return $lijst;
    }
    
}
