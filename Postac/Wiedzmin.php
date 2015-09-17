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
    private $czyWypiy = false;

    /**
     * Zwraca wartośc true i aktywuje funkcję obrony
     * @return boolean
     * 
     */
    public function __construct($param) {
        $this->param = new \Parameters();
        $this->param->setStringParameter($param);
        $this->zycie = $this->param->getZycie();
        $this->setName($param[0][name]);
    }
    
    
    public function wykonajObrone() {
        $dodaj = ($this->param->getZrecznosc() / 2); //50%

        $this->param->setZrecznosc($this->param->getZrecznosc() + $dodaj);
        $this->aktywnaObrona = true;

        return "Obrona";
    }

    /**
     * Sprawadza obrone i zmniejsza zrecznosc
     * @return boolean
     */
    public function koniecobrony() {
        if ($this->aktywnaObrona == true) {
            $odejmij = ($this->param->getZrecznosc() / 3);

            $this->param->setZrecznosc($this->param->getZrecznosc() - $odejmij);

            $this->aktywnaObrona = false;
        }

        return $this->aktywnaObrona;
    }

    /**
     * Tworzy obiekt eliksir
     */
    public function utworz_eliksir() {
        if ($this->iloscElixir > 0) {
            $poziom=rand(1,3);
            $this->eliksir = new \Eliksir($this, $poziom);
            $this->iloscElixir--;
            return "Eliksir Zostal utworzony";
        }
    }

    /**
     * sprawdza czas trwania eliksiru
     */
    public function czas_trwania() {
        if (isset($this->eliksir) && $this->wypij == true) {
            $this->wypij = $this->eliksir->czas_trwania();
        }
    }

    /**
     * uzywa obiektu eliksir zmienia parametry
     * ustawia czas trwania zmienionych parametrów
     * 
     */
    public function wypij() {
        $this->czywypity();
        $this->czyWypiy = true;
        switch (rand(1, 3)) {
            case 1:
                $this->eliksir->zycie();
                $this->czas_trwania();
                $this->wypij = true;
                return "wypito eliksir zycie";
            case 2:
                $this->eliksir->sila();
                $this->czas_trwania();
                $this->wypij = true;
                return "wypitio eliksir sila";
            case 3:
                $this->eliksir->szybkosc();
                $this->czas_trwania();
                $this->wypij = true;
                return "wypito eliksir szybkosc";

            default:
               return "Podaj z przedzialu 1-3";
        }
    }

    /**
     * wysyła komunikat ze  obiekt elikis juz został uzyty 
     * @return boolean
     */
    public function czywypity() {
        if ($this->czyWypiy == true) {
            \Console::write("Zosta.....");
            return true;
        }
    }

    /**
     * Zwraca imie postaci
     * @return string  
     */
    public function getName() {
        return 'jestem Wiedzmin';
    }
    public function getGold(){
        $this->db=bazadanych::getInstance();
        $bohater_id=$this->bohater_id;
        $sql= "select * from bohater where 'bohater_id' = $bohater_id";
        $query = $this->db -> prepare($sql);
        $query -> execute(array($bohater_id));
        $result = $query -> fetchAll();
        return $result[0][gold];
    }

    public function setGold($gold){
     $this->db=bazadanych::getInstance();
     $bohater_id=$this->bohater_id;
     $sql="UPDATE poziom SET gold=:gold WHERE bohater_id=:bohater_id";
     $query= $query = $this->db -> prepare($sql);
     $query -> execute(array($gold,$bohater_id));
    }
    
    public function aktywnyEkwipunek($bron){
      
            if ($bron->gettype() == 'bron') {
                $this->bron = $bron;
                return "Ustawiono nowa bron";
            }
            if ($bron->gettype()== 'zbroja') {
                $this->zbroja =$bron;
                return "Ustawiono nowa zbroja";
            } 
           
        }
    
}