<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ladowanie
 *
 * @author andrzej.mroczek
 */
class Ladowanie {
    
    public function szablon($variable = null){
        extract($variable);
        if(!empty($_GET['strona'])){
            if(file_exists(__DIR__.'/Szablony/'. $_GET['strona'].'.php')){
                include './Szablony/'. $_GET['strona'].'.php';
            }
        }
    }
    
    public function getPOST(){
        return $_POST;
    }
    
    public function getSzablon() {
        return $_GET['strona'];
    }
    public function jestWyslany(){
        if($_POST) {
            return true;
        }
        return false;
    }
    
}
