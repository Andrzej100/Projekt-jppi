<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Wyborpostaci
 *
 * @author andrzej.mroczek
 */
class Wyborpostaci {
    private $uzytkownik;
    public function __construct(Uzytkownik $uzytkownik){
        $this->uzytkownik = $uzytkownik;
    }
    public function pobierz(){
        $db=bazadanych::getInstance();
        $wynik=$db->select('Postac',array('id_uzytkownika'=>$this->uzytkownik->getId()));
        
       // if($wynik == false){
         //   return false;
        //}
        
        return $wynik;
    }
   public function utwoz($imie){
       $db=bazadanych::getInstance();
       $db->zapisz('postac',array('imie'=>$imie,'sila'=>1,'zrecznosc'=>1,'szybkosc'=>1,'zycie'=>1,'zloto'=>0,'dosw'=>0,'wygrane'=>0,'przegrane'=>0,'id_uzytkownika'=>$this->uzytkownik->getID())); 
   }

 public function wybierz($id){
     $db=bazadanych::getInstance();
     $wynik=$db->select('postac',array('id'=>$id));
     if($wynik == false){
            return false;
        }
        
        return $wynik;
 }
}