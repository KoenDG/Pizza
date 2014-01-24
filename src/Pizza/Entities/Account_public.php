<?php

namespace Pizza\Entities;

class Account_public {
    
    private $id,$gemeente_id,$vnaam,$anaam,$leveradres,$huisNr,$telefoon;
    
    public function __construct($id,$gemeente_id,$vnaam,$anaam,$leveradres,$huisNr,$telefoon) {
        $this->id = $id;
        $this->gemeente_id = $gemeente_id;
        $this->vnaam = $vnaam;
        $this->anaam = $anaam;
        $this->leveradres = $leveradres;
        $this->huisNr = $huisNr;
        $this->telefoon = $telefoon;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getGemeenteId() {
        return $this->gemeente_id;
    }
    
    public function getVnaam() {
        return $this->vnaam;
    }
    
    public function getAnaam() {
        return $this->anaam;
    }
    
    public function getLeveradres() {
        return $this->leveradres;
    }
    
    public function getHuisNr() {
        return $this->huisNr;
    }
    
    public function getTelefoon() {
        return $this->telefoon;
    }
    
    //Geen setters want dit is een view.
    
}
