<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sesja2
 *
 * @author Andrzej
 */
class Sesja2 {
private $session;

public function sessionstart(){
    if($this->session==true){
        session_start();
    }
}
 public function sessionset(){
     $this->session=true;
 }   
 public function sessionclose(){
     session_unset();
     session_destroy();
 }
}
