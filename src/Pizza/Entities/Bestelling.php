<?php

namespace Pizza\Entities;

class Bestelling {

    private $id, $account_id, $afgehandeld, $tBesteld;
    
    public function __construct($id, $account_id, $afgehandeld, $tBesteld) {
        $this->id = $id;
        $this->account_id = $account_id;
        $this->afgehandeld = $afgehandeld;
        $this->tBesteld = $tBesteld;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getAccountId() {
        return $this->account_id;
    }
    
    public function getAfgehandeld() {
        return $this->afgehandeld;
    }
    
    public function getTBesteld() {
        return $this->tBesteld;
    }
    
    public function setAccountId($account_id) {
        $this->account_id = $account_id;
    }
    
    public function setAfgehandeld($afgehandeld) {
        $this->afgehandeld = $afgehandeld;
    }
    
    public function setTBesteld($tBesteld) {
        $this->tBesteld = $tBesteld;
    }

}
