<?php

namespace Pizza\Entities;

class Gemeente {

    private $id, $naam, $code, $leverbaar;

    public function __construct($id, $naam, $code, $leverbaar) {
        $this->id = $id;
        $this->naam = $naam;
        $this->code = $code;
        $this->leverbaar = $leverbaar;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNaam() {
        return $this->naam;
    }
    
    public function getCode() {
        return $this->code;
    }
    
    public function getLeverbaarheid() {
        return $this->leverbaar;
    }
    
    public function setNaam($naam) {
        $this->naam = $naam;
    }
    
    public function setCode($code) {
        $this->code = $code;
    }
    
    public function setLeverbaarheid($leverbaar) {
        $this->leverbaar = $leverbaar;
    }
    
    public function toArray() {
        return array("id" => $this->id, "naam" => $this->naam, "code" => $this->code, "leverbaar" => $this->leverbaar);
    }
}
