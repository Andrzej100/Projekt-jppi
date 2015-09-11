<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Statystyki
 *
 * @author andrzej.mroczek
 */
class Statystyki {
   
    
    public function statystykiform(){
        $statystyki=array('sila','zrecznosc','szybkosc','zycie');
        for($i=0; $i<4; $i++){
        $form='<form action="index.php" method="POST">
                <input type="hidden" name="statystyki" value='+$statystyki[$i]+'>
               <input type="submit" value='+$statystyki[$i]+'>
                </form>';
        }
    }
}



