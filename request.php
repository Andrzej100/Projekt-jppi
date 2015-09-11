<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of request
 *
 * @author andrzej.mroczek
 */
class request {
    public function getpost($filter) {
        return filter_input(INPUT_POST, $filter);
        
    }
    
    public function getsession($filter){
        return filter_input(INPUT_SESSION,$filter);
    }
    
    public function setsession(array $filter){
        $_SESSION = $filter;
    }
    
    public function addsession( $key, $value){
        $_SESSION[$key] = $value;
    }
    
    
   
    
}
