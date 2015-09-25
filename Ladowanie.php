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
    

    
    
    public static function laduj($wartosc,$dane){
         $session = Sesja::getInstance();     
              if($_GET['cofnij']){
                  $session->delete($_GET['unset']);
              }
              $strona= $_GET['strona'];
              $this->$strona.'('.$session.')';
              if($wartosc==true){
                  $this->$strona.'('.$session.','.$dane.')';
              }           
    } 
    
    public function przeciwnik($session,$dane=null){
        $przeciwnik= new Przeciwnik();
               $przeciwnicy=$przeciwnik->wszyscyprzeciwnicy();
               $session->setUp(array('przeciwnik'=>$przeciwnik));
               $session->setUp(array('wynik'=>$przeciwnicy));
               if($dane!=null){
                  $przeciwnik= $session->get('przeciwnik');
                  $przeciwnik->wybranyprzeciwnik($dane['wybor']);
                  $potwor= new Postac\Potwor($przeciwnik);
                  $session->setUp(array('potwor'=>$potwor));
               }
    }
        }





    
