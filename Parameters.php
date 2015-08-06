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

        $p = $this->checkparameter($string);

        $this->setSzybkosc($p[0]);
        $this->setSila($p[1]);
        $this->setZrecznosc($p[2]);
        $this->setZycie($p[3]);
    }

    /**
     * Rozdziela poszcególne parametry i wpisuje do atblicy
     * Sprawdza poprawność wpisanych parametrów
     * @param type $parametr
     * @return type
     * @throws Exception
     */
    private function checkparameter($parametr) {
        if (strlen($parametr) > 4) {
            throw new Exception("Error: za dużo parametrów");
        }
        if (strlen($parametr) < 4) {
            throw new Exception("Error: za mało parametrów");
        }

        $explodeParamerter = str_split($parametr);

        foreach ($explodeParamerter as $e) {

            $this->checkIsString($e);
        }

        return $explodeParamerter;
    }

    /**
     * Sprawdza czy poszczególny parametr jest typu numerycznego czy string
     * @param type $param
     * @throws Exception
     */
    public function checkIsString($param) {
        if (!is_numeric($param)) {
//            echo 'string';
            throw new Exception("Error: musi być liczba");
        }
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
