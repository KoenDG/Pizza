<?php

namespace Pizza\Entities;

class Account {
    
    private $id,$gemeente_id,$email,$paswoord,$salt,$registratiedatum,$vnaam,$anaam,$leveradres,$huisNr,$telefoon;
    
    public function __construct($id,$gemeente_id,$email,$paswoord,$salt,$registratiedatum,$vnaam,$anaam,$leveradres,$huisNr,$telefoon) {
        $this->id = $id;
        $this->gemeente_id = $gemeente_id;
        $this->email = $email;
        $this->paswoord = $paswoord;
        $this->salt = $salt;
        $this->registratiedatum = $registratiedatum;
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
    
    public function getEmail() {
        return $this->email;
    }
    
    public function getPaswoord() {
        return $this->paswoord;
    }
    
    public function getSalt() {
        return $this->salt;
    }
    
    public function getRegistratiedatum() {
        return $this->registratiedatum;
    }
    
    public function getVNaam() {
        return $this->vnaam;
    }
    
    public function getANaam() {
        return $this->anaam;
    }
    
    public function getLeverAdres() {
        return $this->leveradres;
    }
    
    public function getHuisNr() {
        return $this->huisNr;
    }
    
    public function getTelefoon() {
        return $this->telefoon;
    }
    
    public function setGemeenteId($gemeente_id) {
        $this->gemeente_id = $gemeente_id;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function setPaswoord($paswoord) {
        $this->paswoord = $paswoord;
    }
    
    public function setSalt($salt) {
        $this->salt = $salt;
    }
    
    public function setRegistratiedatum($registratiedatum) {
        $this->registratiedatum = $registratiedatum;
    }
    
    public function setVNaam($vnaam) {
        $this->vnaam = $vnaam;
    }
    
    public function setANaam($anaam) {
        $this->anaam = $anaam;
    }
    
    public function setLeverAdres($leveradres) {
        $this->leveradres = $leveradres;
    }
    
    public function setHuisNr($huisNr) {
        $this->huisNr = $huisNr;
    }
    
    public function setTelefoon($telefoon) {
        $this->telefoon = $telefoon;
    }    
}
