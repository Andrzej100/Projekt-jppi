<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ekwipunek
 *
 * @author andrzej.mroczek
 */
class Ekwipunek {

    private $ekwipunek;
    private $aktywne;
    private $bron;
    private $zbroja;

    public function __construct($ekwipunek, $aktywne) {
        $this->ekwipunek($ekwipunek);

        $this->aktywne($aktywne);
    }

    public function aktywne($aktywne) {
        if ($aktywne != null) {
            if ($aktywne[0] != null) {
                $this->bron = new Bron($aktywne[0]);
            }
            if ($aktywne[1] != null) {
                $this->zbroja = new Zbroja($aktywne[1]);
            }
        }
    }

    public function ekwipunek($ekwipunek) {
        if ($ekwipunek != null) {
            for ($i = 0; $i < count($ekwipunek); $i++) {
                $this->ekwipunek = $ekwipunek[$i]['name'] + ' ' + $ekwipunek[$i]['param'] + '/n';
            }
        }
    }

}
