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
class Rejestracja {

    private $uzytkownik;

    public function __construct(Uzytkownik $uzytkownik) {
        $this->uzytkownik = $uzytkownik;
        
    }
    
    public function zapisz() {
        //zapisanie do bazy
        
        $db = bazadanych::getInstance();
        $db->zapisz('uzytkownik', array(
            'login'=>$this->uzytkownik->getLogin(),
            'haslo'=>$this->uzytkownik->getHaslo()
        ));
    }
    
}
