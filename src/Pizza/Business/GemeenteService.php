<?php

namespace Pizza\Business;

use Pizza\Data;

class GemeenteService {
    
    public static function toonAlleGemeenten() {
        $lijst = Data\GemeenteDAO::getAll();
        return $lijst;
    }
    
    public static function haalGemeenteOp($naam) {
        $gemeente = Data\GemeenteDAO::getByName($naam);
        return $gemeente;
    }
    
}
