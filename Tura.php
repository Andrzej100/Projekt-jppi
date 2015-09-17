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

    /**
     * Sprawdza czy pobrany obiektma parametr życie mniejszy bądź równy 0
     * @return boolean
     */
    public function sprawdzCzyKoniec() {
        if ($this->gracz->Getparam()->getZycie() <= 0) {
            Console::write("Koniec gry");
            return false;
        }
        elseif($this->przeciwnik->Getparam()->getZycie() <= 0){
            Console::write("Koniec gry wygrales!!!");
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
        $this->kolejg=true;
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
        
        if($this->punktygracz>0 && $this->kolejg==true){
            return $this->opcja($opcja);
        }
    }

   public function akcja2(){
       
       if($this->punktyprzeciwnik>0 && $this->punktygracz<=0){
       $this->kolejp=true;
       return;
       }
       elseif($this->punktygracz>0){
           return $this->wyborruchu();
       }
   }
   public function akcja3(){
       
       if($this->punktyprzeciwnik>0 && $this->kolejp==true){
        return $this->tura_przeciwnika();
        }
        else{return;}
   }
    public function losowanie(){
        if($this->punktyprzeciwnik<=0 && $this->punktygracz<=0){
        $this->aktywne();
            $this->czyjatura();
            $this->gracz->czas_trwania();
            if($this->wyborruchu()!=null){
            return $this->tura_przeciwnika()+"/n"+$this->wyborruchu();}
            else{return $this->wyborruchu();}
        }else{
        return;
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
               return  $this->gracz->wykonajObrone();
               
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
    public function wyborruchu(){
        if($this->kolejg==true){
        return  '<form action="index.php" method="POST>
                  <select name="akcja">
                    <option value="a">Atak</option>
                    <option value="b">Stworzenie Eiksiru</option>
                    <option value="c">Wypicie Eliksiru</option>
                    <option value="d">Obrona</option>
                    <option value="null">Koniec Tury</option>
                    </select>
                    <input type="submit" value="Wybierz akcje">
              </form>';
        }
    }
    public function utwurzeliksirform(){
        return  '<form action="index.php" method="POST>
                 
                  
                    <input type="submit" value="Wybierz akcje">
              </form>';
    }
     public function wyborprzeciwnika(){
         return  '<form action="index.php" method="POST>
                  <select name="potwor">
                    <option value="potwor1">Potwor1</option>
                    <option value="potwor2">Potwor2</option>
                    <option value="potwor3">Potwor3</option>
                    <option value="potwor4">Potwor4</option>
                    <option value="potwor5">Potwor5</option>
                    </select>
                    <input type="submit" value="Wybierz Przeciwnika">
              </form>';
    }
}
