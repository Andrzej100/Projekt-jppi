<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of bron
 *
 * @author Andrzej
 */
class bron {
   
    private $przedmiot;
    
    private $typ;
    
    private $parametr1;
    
    private $parametr2;
    
    private $nazwa;
    
    public function __construct($przedmiot){
        
        
        $this->typ=$przedmiot[0]['typ'];
        
        $this->parametr1=$przedmiot[0]['param1'];
        
        $this->parametr2=$przedmiot[0]['param2'];
        
        $this->nazwa=$przedmiot[0]['nazwa'];
        
    }
    public function gettype(){
        return $this->typ;
    }
    
    public function getname(){
        return $this->nazwa;
    }
    
    public function getparam1(){
        return $this->parametr1;
    }
    
    public function getparam2(){
        return $this->parametr2;
    }
}
