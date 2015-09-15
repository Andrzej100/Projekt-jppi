<?php

namespace Postac;
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
class Potwor extends Postac {
    
    public function __construct($name){
        $potwor=$this->getPotwor($name);
        $this->param = new \Parameters();
        $this->param->setStringParameter($potwor);
        $this->zycie = $this->param->getZycie();
        $this->setName($name);
        
    }
    public function getPotwor($name){
        $this->db=bazadanych::getInstance();
        $sql= "select * from potwor where 'potwor_name' = $name";
        $query = $this->db->prepare($sql);
        $query -> execute(array($name)); 
        $result = $query -> fetchAll();
        return $result;
    }
    
    public function getName() {
        return $this->name;
    }
    
}

