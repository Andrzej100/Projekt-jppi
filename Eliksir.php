<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Eliksir {

    /**
     *
     * @var Postac\Postac
     */
    private $postac;
    private $poziom;
    private $czas=3;
    private $typ;

    public function __construct(Postac\Wiedzmin $gracz,$poziom) {
        $this->postac = $gracz;
        $this->poziom=$poziom;
    }

    public function sila() {
        $sila = $this->postac->Getparam()->getSila();
        $this->postac->Getparam()->setSila($sila + $this->poziom);
        $this->typ='sila';
    }

    public function szybkosc() {
        $szybkosc = $this->postac->Getparam()->getSzybkosc();
        $this->postac->Getparam()->setSzybkosc($szybkosc + $this->poziom);
        $this->typ='szybkosc';
    }

    public function zycie() {
        $this->postac->Getparam()->setZycie($this->postac->Getparam()->getZycie() + $this->poziom);
    }
    public function czas_trwania(){

          if($this->czas>0){
              --$this->czas;
              return true;
          }
          elseif($this->czas==0){
              $this->odejmij_bonus();
              $this->czas=3;
              echo"koniec czasu";
              return false;
             }


    }
    public function odejmij_bonus(){
        if($this->typ=="szybkosc"){
           $szybkosc = $this->postac->Getparam()->getSzybkosc();
           $this->postac->Getparam()->setSzybkosc($szybkosc - $this->poziom);
        }
        elseif($this->typ=="sila"){
            $sila = $this->postac->Getparam()->getSila();
            $this->postac->Getparam()->setSila($sila - $this->poziom);
        }
    }

}
