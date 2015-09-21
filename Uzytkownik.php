<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rejestracja
 *
 * @author andrzej.mroczek
 */
class Uzytkownik {
    
    private $login;
    private $haslo;
    private $id;
    
    public function __construct($login = null, $haslo = null) {
        if(!empty($login) && !empty($haslo)){
            $this->setLogin($login);
            $this->setHaslo($haslo);
        }elseif(!empty($login) &&  is_array($login)){
            $this->setId($login['id']);
            $this->setLogin($login['login']);
            $this->setHaslo($login['haslo']);
        }
    }
    
    public function setId($id){
        $this->id=$id;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function setLogin($login) {
        $this->login = $login;
    }
    
    public function getLogin() {
        return $this->login;
    }
    public function setHaslo($haslo) {
        $this->haslo = $haslo;
    }
    
    public function getHaslo() {
        return $this->haslo;
    }
    
    
}
