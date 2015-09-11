<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Potwor
 *
 * @author andrzej.mroczek
 */
abstract class Potwor {
    
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
}
