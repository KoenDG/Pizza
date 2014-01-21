<?php

namespace Pizza\Entities;

class Pizza {

    //Als een klant 3 keer dezelfde pizza bestelt, moet er niet 3 keer een aparte instantie aangemaakt worden.
    private static $idMap = array();
    private $id, $naam, $prijs, $beschikbaar, $calorien, $samenstelling, $omschrijving, $foto;

    private function __construct($id, $naam, $prijs, $beschikbaar, $calorien, $samenstelling, $omschrijving, $foto) {
        $this->id = $id;
        $this->naam = $naam;
        $this->prijs = $prijs;
        $this->beschikbaar = $beschikbaar;
        $this->calorien = $calorien;
        $this->samenstelling = $samenstelling;
        $this->omschrijving = $omschrijving;
        $this->foto = $foto;
    }

    public static function create($id, $naam, $prijs, $beschikbaar, $calorien, $samenstelling, $omschrijving, $foto) {
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new Genre($id, $naam, $prijs, $beschikbaar, $calorien, $samenstelling, $omschrijving, $foto);
        }
        return self::$idMap[$id];
    }

    public function getId() {
        return $this->id;
    }

    public function getNaam() {
        return $this->naam;
    }

    public function getPrijs() {
        return $this->prijs;
    }

    public function getBeschikbaarheid() {
        return $this->beschikbaar;
    }

    public function getCalorien() {
        return $this->calorien;
    }

    public function getSamenstelling() {
        return $this->samenstelling;
    }

    public function getOmschrijving() {
        return $this->omschrijving;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function setNaam($naam) {
        $this->naam = $naam;
    }

    public function setPrijs($prijs) {
        $this->prijs = $prijs;
    }

    public function setBeschikbaarheid($beschikbaar) {
        $this->beschikbaar = $beschikbaar;
    }

    public function setCalorien($calorien) {
        $this->calorien = $calorien;
    }

    public function setSamenstelling($calorien) {
        $this->calorien = $calorien;
    }

    public function setOmschrijving($omschrijving) {
        $this->omschrijving = $omschrijving;
    }

    //Dit zal het pad zijn op de harddrive
    public function setFoto($foto) {
        $this->foto = $foto;
    }
}
