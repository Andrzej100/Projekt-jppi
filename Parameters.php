<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Parameters
 *
 * @author andrzej.mroczek
 */
class Parameters {

    private $szybkosc;
    private $sila;
    private $zrecznosc;
    private $zycie;
    private $pktakcji = 1;

    /**
     * Ustawia parametry postaci
     * wywołuje funkcje checkparameter
     * @param type $string
     */
    public function setStringParameter($string) {

        $this->setSzybkosc($string[0][2]);
        $this->setSila($string[0][3]);
        $this->setZrecznosc($string[0][4]);
        $this->setZycie($string[0][5]);
    }
     
    
    
    
    
    /**
     * Ustawia wartsośc parametru szybkość
     * @param type $value
     */
    public function setSzybkosc($value) {
        $this->szybkosc = $value;
    }

    /**
     * Ustawia wartsośc parametru siła
     * @param type $value
     */
    public function setSila($value) {
        $this->sila = $value;
    }

    /**
     * Ustawia wartsośc parametru zręczność
     * @param type $value
     */
    public function setZrecznosc($value) {
        $this->zrecznosc = $value;
    }

    /**
     * Ustawia wartsośc parametru zycie
     * @param type $value
     */
    public function setZycie($value) {
        $this->zycie = $value;
    }

    /**
     * Zwraca wartośc parametru szybkość
     * @return type
     */
    public function getSzybkosc() {
        return $this->szybkosc;
    }

    /**
     * Zwraca wartośc parametru siła
     * @return type
     */
    public function getSila() {
        return $this->sila;
    }

    /**
     * Zwraca wartośc parametru zręczność
     * @return type
     */
    public function getZrecznosc() {
        return $this->zrecznosc;
    }

    /**
     * Zwraca wartośc parametru życie
     * @return type
     */
    public function getZycie() {
        return $this->zycie;
    }

    /**
     * Ustawia wartsośc parametru punkty akcji
     * @param int $value
     */
    public function setpktakcji($value) {
        if ($value < 2) {
            $value = 1;
        }

        $this->pktakcji = $value;
    }

    /**
     * Zwraca wartośc parametru punkty akcji
     * @return type
     */
    public function getpktakcji() {
        return $this->pktakcji;
    }

}
