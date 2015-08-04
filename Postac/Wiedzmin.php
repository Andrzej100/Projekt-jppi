<?php

namespace Postac;

/**
 * Description of Wiedzmin
 *
 * @author piotr.switala <piotr.switala@powiat.poznan.pl>
 */
class Wiedzmin extends Postac {

    private $aktywnaObrona = false;
    private $eliksir;
    private $wypij;
    private $iloscElixir = 1;

    public function wykonajObrone() {
        $dodaj = ($this->param->getZrecznosc() / 2); //50%

        $this->param->setZrecznosc($this->param->getZrecznosc() + $dodaj);
        $this->aktywnaObrona = true;

        return true;
    }

    public function koniecobrony() {
        if ($this->aktywnaObrona == true) {
            $odejmij = ($this->param->getZrecznosc() / 3);

            $this->param->setZrecznosc($this->param->getZrecznosc() - $odejmij);

            $this->aktywnaObrona = false;
        }

        return $this->aktywnaObrona;
    }

    public function utworz_eliksir() {
        //if ($this->iloscElixir > 0) {
        $poziom = \Console::read();
        $this->eliksir = new \Eliksir($this, $poziom);
        //    $this->iloscElixir--;
        //}
    }

    public function wypij() {
        switch (rand(1, 3)) {
            case 1:
                $this->eliksir->zycie();
                $this->czas_trwania();
                $this->wypij = true;
                break;
            case 2:
                $this->eliksir->sila();
                $this->czas_trwania();
                $this->wypij = true;
                break;
            case 3:
                $this->eliksir->szybkosc();
                $this->czas_trwania();
                $this->wypij = true;
                break;

            default:
                \Console::write("Podaj z przedzialu 1-3");
                break;
        }
    }

    public function getName() {
        return 'jestem Wiedzmin 2';
    }

    public function czas_trwania() {
        if (isset($this->eliksir) && $this->wypij == true) {
            $this->wypij = $this->eliksir->czas_trwania();
        }
    }

}
