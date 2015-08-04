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
    private $pktakcji=1;

    public function setStringParameter($string) {

        $p = $this->checkparameter($string);

        $this->setSzybkosc($p[0]);
        $this->setSila($p[1]);
        $this->setZrecznosc($p[2]);
        $this->setZycie($p[3]);
    }


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

    public function checkIsString($param) {
        if (!is_numeric($param)) {
//            echo 'string';
            throw new Exception("Error: musi być liczba");
        }
    }


    public function setSzybkosc($value) {
        $this->szybkosc = $value;
    }

    public function setSila($value) {
        $this->sila = $value;
    }

    public function setZrecznosc($value) {
        $this->zrecznosc = $value;
    }

    public function setZycie($value) {
        $this->zycie = $value;
    }

    public function getSzybkosc() {
        return $this->szybkosc;
    }

    public function getSila() {
        return $this->sila;
    }

    public function getZrecznosc() {
        return $this->zrecznosc;
    }

    public function getZycie() {
        return $this->zycie;
    }
public function setpktakcji($value){
    if($value < 2) {
        $value = 1;
    }

    $this->pktakcji = $value;
}
public function getpktakcji(){
   return $this->pktakcji;
}
}
