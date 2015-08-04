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

    public function dodajGracza(Postac\Wiedzmin $wiedzmin) {
        $this->gracz = $wiedzmin;
    }

    public function dodajPrzeciwnika(Postac\Potwor $potwor) {
        $this->przeciwnik = $potwor;
    }

    public function sprawdzCzyKoniec()
    {
        if ( $this->gracz->getZycie() <= 0 ) {
            Console::write("Koniec gry");
            return false;
        }
        return true;
    }

public function aktywne(){
    $this->punktyakcji();
        $this->gracz->koniecobrony();

}
 private function wiadomosc(Postac\Postac $postac) {

        Console::write($postac->Getparam()->getSzybkosc());
        Console::write($postac->Getparam()->getSila());
        Console::write($postac->Getparam()->getZrecznosc());
        Console::write($postac->getZycie());
    }
    public function akcja($opcja) {
       for($i=0; $i<$this->gracz->Getparam()->getpktakcji(); $i++) {
            switch ($opcja) {
                case "a":

                    $this->gracz->wykonajAtak($this->przeciwnik);
                    break;
                case "b":
                    Console::write("Podaj poziom Eliksiru");
                   $this->gracz->utworz_eliksir();
                    break;
                case "c":
                    $this->gracz->wypij();
                    break;
                case "d":
                    $this->gracz->wykonajObrone();
                    break;

                default:
    //                exit();
                    break;
            }
        }

     $this->tura_przeciwnika();

    }

    public function punktyakcji() {
        $szybkoscg=$this->gracz->Getparam()->getSzybkosc();
        $szybkoscp=$this->przeciwnik->Getparam()->getSzybkosc();
        if($szybkoscg > $szybkoscp){
           $punkty=$this->obliczpunkty($szybkoscg,$szybkoscp);
           $this->gracz->Getparam()->setpktakcji($punkty);

        }
        elseif($szybkoscg < $szybkoscp){
            $punkty=$this->obliczpunkty($szybkoscp,$szybkoscg);
            $this->przeciwnik->Getparam()->setpktakcji($punkty);
        }
    }

    public function obliczpunkty($szybkoscg,$szybkoscp){
           $punkty=Floor($szybkoscg/$szybkoscp);
           --$punkty;

           return $punkty;
    }
    public function tura_przeciwnika(){
        for ( $i = 0; $i < $this->przeciwnik->Getparam()->getpktakcji(); $i++ ) {
            Console::write("atak przeciwnika");
            $this->przeciwnik->wykonajAtak($this->gracz);
            $this->gracz->czas_trwania();
            $this->wiadomosc($this->gracz);
    }
    }
}
