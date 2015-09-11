<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Postac;

/**
 *
 * @author piotr.switala
 */
abstract class Postac {

    /**
     *
     * @var \Parameters
     */
    protected $param;
    public $zycie;
    public $name;

    /**
     * Konstruktor pobiera parametry postaci
     * @param type $param
     */
    public function __construct($param) {
        $this->param = new \Parameters();
        $this->param->setStringParameter($param);
        $this->zycie = $this->param->getZycie();
        $this->setName($param[name]);
    }

    public function setName($name){
        $this->name=$name;
    }
    public abstract function getName();

    /**
     * Wykonuje atak i sprawdza czy skuteczny
     * @param \Postac\Postac $postac
     */
    public function wykonajAtak(Postac $postac) {
        if ($this->czyAtakSkutecznoy($postac)) {
            $this->odbierzPunkt($postac);
        }
    }

    /**
     * Odbiera punkty postaci wywoływana przez wykonajAtak
     * @param \Postac\Postac $postac
     */
    private function odbierzPunkt(Postac $postac) {
        $postac->Getparam()->setZycie($postac->Getparam()->getZycie()-1);
    }

    /**
     * Oblicza czy atak jest skuteczny wdl wzoru podanego
     * @param \Postac\Postac $postac
     * @return boolean
     */
    private function czyAtakSkutecznoy(Postac $postac) {
        $skutecznosc = $this->param->getZrecznosc() - $postac->getzrecznosc() * 100;
        $skutecznosc /= ($postac->getzrecznosc() * 100);

        if ($skutecznosc < 10) {
            $skutecznosc = 10;
        } elseif ($skutecznosc > 90) {
            $skutecznosc = 90;
        }

        if (rand(1, 100) >= $skutecznosc) {

            return true;
        }

        return false;
    }

    /**
     * Zwraca wartość parametru zycie
     * @return type
     */
    public function getZycie() {
        return $this->zycie;
    }

    /**
     * Ustawia wartośc parametru życie
     * @param type $value
     */
    protected function setZycie($value) {
        $this->param->setZycie($value);
    }

    /**
     * Zwraca wartość parametru zręczność
     * @return type
     */
    public function getzrecznosc() {
        return $this->param->getZrecznosc();
    }

    /**
     * Zwraca obiekt Parameters
     * @return type
     */
    public function Getparam() {
        return $this->param;
    }

}
