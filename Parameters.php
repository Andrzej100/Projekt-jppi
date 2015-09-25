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
    private $id;
    private $gold;

    /**
     * Ustawia parametry postaci
     * wywołuje funkcje checkparameter
     * @param type $string
     */
    public function setStringParameter($string) {

        $this->setSzybkosc($string[0]['szybkosc']);
        $this->setSila($string[0]['sila']);
        $this->setZrecznosc($string[0]['zrecznosc']);
        $this->setZycie($string[0]['zycie']);
        $this->setGold($string[0]['zloto']);
        $this->setId($string[0]['id']);
        
    }
     
    
    
    
    public function getParameters(){
        $param[]=$this->sila;
        $param[]=$this->szybkosc;
        $param[]=$this->zrecznosc;
        $param[]=$this->zycie;
        return $param;
    }
    /**
     * Ustawia wartsośc parametru szybkość
     * @param type $value
     */
    public function setSzybkosc($value) {
        $db = bazadanych::getInstance();
        $db->update('postac',array('szybkosc'=>$value),array('id'=>$this->getId()));
        $this->szybkosc = $value;
    }

    /**
     * Ustawia wartsośc parametru siła
     * @param type $value
     */
    public function setSila($value) {
        $db = bazadanych::getInstance();
        $db->update('postac',array('sila'=>$value),array('id'=>$this->getId()));
        $this->sila = $value;
    }

    /**
     * Ustawia wartsośc parametru zręczność
     * @param type $value
     */
    public function setZrecznosc($value) {
        $db = bazadanych::getInstance();
        $db->update('postac',array('zrecznosc'=>$value),array('id'=>$this->getId()));
        $this->zrecznosc = $value;
    }

    /**
     * Ustawia wartsośc parametru zycie
     * @param type $value
     */
    public function setZycie($value) {
        $db = bazadanych::getInstance();
        $db->update('postac',array('zycie'=>$value),array('id'=>$this->getId()));
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
    public function setGold($gold){
        $db = bazadanych::getInstance();
        $db->update('postac',array('zloto'=>$value),array('id'=>$this->getId()));
        $this->gold=$gold;
    }
   public function setId($id){
       $this->id=$id;
   }
   public function getId(){
       return $this->id;
   }
   public function getGold(){
       return $this->gold;
   }
}
