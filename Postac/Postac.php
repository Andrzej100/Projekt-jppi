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

    public function __construct($param) {
        $this->param = new \Parameters();
        $this->param->setStringParameter($param);
        $this->zycie = $this->param->getZycie();
    }

    public abstract function getName();

    public function wykonajAtak(Postac $postac) {
        if ($this->czyAtakSkutecznoy($postac)) {
            $this->odbierzPunkt($postac);
        }
    }

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

    public function jedz() {
        return "Czas na jedzenie";
    }

    public function getZycie() {
        return $this->zycie;
    }

    protected function setZycie($value) {
        $this->param->setZycie($value);
    }

    public function getzrecznosc() {
        return $this->param->getZrecznosc();
    }

    private function odbierzPunkt(Postac $postac) {
        $postac->zycie = $postac->zycie - 1;
    }

public function Getparam(){
    return $this->param;

}


}
