<?php

namespace Pizza\Entities;

class Bestelling_Detail {
    
    private $bestelling_id, $pizza_id;
    
    public function __construct($bestelling_id, $pizza_id) {
        $this->bestelling_id = $bestelling_id;
        $this->pizza_id = $pizza_id;
    }
    
    public function getBestellingId() {
        return $this->bestelling_id;
    }
    
    public function getPizzaId() {
        return $this->pizza_id;
    }
    
    public function setBestellingId($bestelling_id) {
        $this->bestelling_id = $bestelling_id;
    }
    
    public function setPizzaId($pizza_id) {
        $this->pizza_id = $pizza_id;
    }
    
}