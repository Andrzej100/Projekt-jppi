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
     * Wyświetla parametry Gracza
     * @param Postac\Postac $postac
     */
    private function wiadomosc(Postac\Postac $postac) {

        Console::write($postac->Getparam()->getSzybkosc());
        Console::write($postac->Getparam()->getSila());
        Console::write($postac->Getparam()->getZrecznosc());
        Console::write($postac->Getparam()->getZycie());
    }

    /**
     * Wywołuje truę przeciwnika
     * Wywołuje funkcję wiadomość oraz czas_trwania
     */
    public function tura_przeciwnika() {
        for ($i = 0; $i < $this->przeciwnik->Getparam()->getpktakcji(); $i++) {
            Console::write("atak przeciwnika");
            $this->przeciwnik->wykonajAtak($this->gracz);
            $this->gracz->czas_trwania();
            $this->wiadomosc($this->gracz);
        }
    }

    /**
     * Wywołuje funkcje akcji w pętli Zależnie od punktów akcji
     * Ustawia turę przeciwnika
     * @param type $opcja
     */
    public function akcja($opcja) {
        for ($i = 0; $i < $this->gracz->Getparam()->getpktakcji(); $i++) {
            $this->opcja($opcja);
        }

        $this->tura_przeciwnika();
    }

    /**
     * Ustawia akcję gracza
     * @param type $opcja
     */
    public function opcja($opcja) {
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

}
