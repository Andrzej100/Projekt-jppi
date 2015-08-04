<?php

/**
 * Description of Game
 *
 * @author piotr.switala <piotr.switala@powiat.poznan.pl>
 */
class Game {


    public function tekst($param) {
        switch ($param) {
            case 1:
                $msg = "wybierz cztery parametry wiedzmina(po przecinku)";
                break;

            case 2:
                $msg = "wybierz cztery parametry potwora(po przecinku)";
                break;

            case 3:
                $msg = "\nTwoja tura jaki ruch wykonasz(a-atak b-stworzenie eliksiru c-wypicie d-obrona e-koniec tury)\n";
                break;

            case 4:
                $msg = "Podaj poziom eliksiru";
                break;

            default:
                $msg = "Error nie ma takiej opcji";
                break;
        }

        return $msg;
    }

    public function start() {

        $tura = new Tura();


        Console::write($this->tekst(1));
        $tura->dodajGracza(new Postac\Wiedzmin(Console::read()));

        Console::write($this->tekst(2));
        $tura->dodajPrzeciwnika(new Postac\Potwor(Console::read()));
        do{
            Console::write($this->tekst(3));
            $tura->aktywne();
            $x = Console::read();
            $tura->akcja($x);
            
            
        }while($tura->sprawdzCzyKoniec());

    }


    private function wiadomosc(Postac\Postac $postac) {

        var_dump($postac);
    }



}