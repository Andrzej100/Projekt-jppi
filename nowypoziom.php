<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of nowypoziom
 *
 * @author andrzej.mroczek
 */
class Nowypoziom {
    private $poziom=array(1=>3,2=>6,3=>12,4=>24,5=>48);
    
    private $dosw;
    
    private $id;
    
    private $punktystatystyk; 
    
    public function __construct($id_postaci) {
        $this->id=$id_postaci;
    }
   
    public function setpoziom($dosw){
        for($i=1; $i<count($this->poziom); $i++){
            if($dosw<$this->poziom[$i]){
                $poziom=$this->poziom[$i];
            }
        }
        return $poziom;
    }
    
    public function getdosw($dosw){
        //pobiera z bazy punkty doswiadczenia
        //sprawdza czy nowy poziom jezeli tak to
        //dodaje pnkty do statystyk
        ////aktualizuje poziom bohatera +1
        //sprawdza czy return poziom jest wiekszy niz poziom bohatera
    }
    public function getpunktydorozdania(){
        //pobiera z bazy punkty do rozdania
       // wyswietla formularz tylko kiedy
        //sa punkty nie rozdane.
    }
    
}
