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
    
    private $poziom=array(1=>15,2=>30,3=>50,4=>80,5=>100);
   
    private $wiedzmin;
    
    
    public function __construct($wiedzmin) {
        $this->wiedzmin=$wiedzmin;
    }
   
    public function pobierz(){
        $db = bazadanych::getInstance();
        $wynik=$db->select('nowypoziom',array('id_postaci'=>$this->wiedzmin->getparam->getId()));
        return $wynik;
    }
    
    public function sprawdzpoziom($poziom){
        foreach($this->poziom as $key=>$value){
            if($this->wiedzmin->Getparam->getDosw>=$value){
               $poziom=$key;
               break;
            }
        }
        return $poziom;
    }
    public function punkty(){
      $wynik=$this->pobierz();
      $poziom=$wynik[0]['poziom'];
      $punkty=$wynik[0]['punkty'];
      $zwiekszpoziom=0;
      $wynik2=$this->sprawdzpoziom($poziom);
      while($wynik2>$poziom){
          $poziom++;
          $zwiekszpoziom++;
      }
      if($zwiekszpoziom==1){
          $punkty+=2;
      }
      $this->zapisz($punkty,$poziom);
      if(!empty($punkty)){
          return true;
      }
    }
    
    
    public function zapisz($punkty,$poziom){
        $db = bazadanych::getInstance();
        $db->update('nowypoziom',array('punkty'=>$punkty,'poziom'=>$poziom),array('id_postaci'=>$this->wiedzmin->getparam->getId()));
    }
    
    
    
}
