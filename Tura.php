<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Tura {

    /**
     *
     * @var Postac\Wiedzmin
     */
    private $gracz;

    /**
     *
     * @var Postac\Postac
     */
    private $przeciwnik;

    /**
     * Dodaje gracza do obiektu Tura
     * @param Postac\Wiedzmin $wiedzmin
     */
    private $punktyprzeciwnik=0;
    
    private $punktygracz=0;
    
    private $kolejg;
    
    private $kolejp;
    
    private $turag;
    
    private $turap;
    
    public function dodajGracza(Postac\Wiedzmin $wiedzmin) {
        $this->gracz = $wiedzmin;
    }

    /**
     * Dodaje przeciwnika do obiektu Tura
     * @param Postac\Potwor $potwor
     */
    public function dodajPrzeciwnika(Postac\Potwor $potwor) {
        $this->przeciwnik = $potwor;
    }
    public function dodajzloto(){
        
       $this->gracz->Getparam->setGold($this->gracz->Getparam->getGold()+$this->przeciwnik->zlotopotwora());
    }
    /**
     * Sprawdza czy pobrany obiektma parametr życie mniejszy bądź równy 0
     * @return boolean
     */
    public function sprawdzCzyKoniec() {
        if ($this->gracz->Getparam()->getZycie() <= 0) {
            return false;
        }
        elseif($this->przeciwnik->Getparam()->getZycie() <= 0){
            return false;
        }
        return true;
    }

    /**
     * wywołuje funkcje Obrona i punkty akcji
     */
    public function aktywne() {
        $this->punktyakcji();
        $this->gracz->koniecobrony();
    }

    /**
     * Wywołuje truę przeciwnika
     * Wywołuje funkcję wiadomość oraz czas_trwania
     */
    public function tura_przeciwnika() {
        if(turag==0){
        $this->kolejg=true;
        $this->kolejp=false;
        $this->turap=1;
        }
        else{$this->kolejp=false;
        $this->turap=1;
        }
        do{
            $this->punktyprzeciwnik--;
            $atak[]=$this->przeciwnik->wykonajAtak($this->gracz);
            ++$ilosc;
        }
        while( $this->punktyprzeciwnik==0);
        return $atak[0]+"*"+$ilosc;
        
    }
    /**
     * Wywołuje funkcje akcji w pętli Zależnie od punktów akcji
     * Ustawia turę przeciwnika
     * @param type $opcja
     */
    public function akcja1($opcja) {
        
            return $this->opcja($opcja);
    }

   //public function akcja2(){
       
      // if($this->punktyprzeciwnik>0 && $this->punktygracz<=0){
      // $this->kolejp=true;
      // return;
       //}
      // elseif($this->punktygracz>0){
        //   return $this->wyborruchu();
      // }
  // }
   public function akcja3(){
       
        return $this->tura_przeciwnika();
        
   }
    public function losowanie(){
        
            $this->aktywne();
            $this->czyjatura();
            $this->gracz->czas_trwania();
            $this->turag=0;
            $this->turap=0;
            if($this->kolejg==false){
            return $this->tura_przeciwnika()."przeciwnik rozpoczyna ture pierwszy";}
            elseif($this->kolejg==true){return "Gracz rozpoczyna ture pierwszy";}
        
    }
    public function nastepny(){
        if($this->turap==0){
            $this->kolejp=true;
            $this->kolejg=false;
            $this->turag=1;
        }
        else{
            $this->kolejg=false;
            $this->turag=1;
        }
    }

    /**
     * Ustawia akcję gracza
     * @param type $opcja
     */
    public function opcja($opcja) {
        switch ($opcja) {
            case "a":
            
                $this->punktygracz--;
                return $this->gracz->wykonajAtak($this->przeciwnik);
                
            case "b":
                $this->punktygracz--;
                return $this->gracz->utworz_eliksir();
            
                case "c":
                $this->punktygracz--;
                return $this->gracz->wypij();
                
            case "d":
                 $this->punktygracz--;
                 $this->nastepny();
               return  $this->gracz->wykonajObrone();
               
            case "e":
                $this->nastepny();
               
            default:
                //                exit();
                break;
        }
    }

    /**
     * Oblicza punkty akcji po każdej turze
     */
    public function punktyakcji() {
        $szybkoscg = $this->gracz->Getparam()->getSzybkosc();
        $szybkoscp = $this->przeciwnik->Getparam()->getSzybkosc();
        if ($szybkoscg > $szybkoscp) {
            $punkty = $this->obliczpunkty($szybkoscg, $szybkoscp);
            $this->gracz->Getparam()->setpktakcji($punkty);
        } elseif ($szybkoscg < $szybkoscp) {
            $punkty = $this->obliczpunkty($szybkoscp, $szybkoscg);
            $this->przeciwnik->Getparam()->setpktakcji($punkty);
        }
        $this->punktygracz=$this->gracz->Getparam()->getpktakcji();
        $this->punktyprzeciwnik=$this->przeciwnik->Getparam()->getpktakcji();        
    }

    /**
     * Dodaje punkty za szybkosć 
     * @param type $szybkoscg
     * @param type $szybkoscp
     * @return type
     */
    public function obliczpunkty($szybkoscg, $szybkoscp) {
        $punkty = Floor($szybkoscg / $szybkoscp);
        --$punkty;

        return $punkty;
    }
public function losowy(){
    $losowy=random(0,1);
    if($losowy==0){
        $this->kolejg=true; $this->koljep=false;
    }
    else{
        $this->kolejp=true; $this->kolejg=false;
        }
    }

    public function czyjatura(){
        $this->punktygracz=$this->gracz->Getparam()->getpktakcji();
        $this->punktyprzeciwnik=$this->przeciwnik->Getparam()->getpktakcji();
        if($this->punktygracz>punktyprzeciwnik){
            $this->kolejg=true; $this->koljep=false;
        }
        elseif($this->punktygracz<punktyprzeciwnik){
            $this->kolejp=true; $this->kolejg=false;
        }
        elseif($this->punktygracz==punktyprzeciwnik){
            $this->losowy();
        }
    }
    public function getKolejg(){
        return $this->kolejg;
    }
    
    public function getKolejp(){
        return $this->kolejg;
    }
   
}
