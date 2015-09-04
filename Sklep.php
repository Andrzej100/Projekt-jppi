<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sklep
 *
 * @author andrzej.mroczek
 */
class Sklep {
    private $wyswietl;
    
    private $przedmioty;
    
    private $wiedzmin;
    
    private $wiedzmininfo;
   
   public function kupuj($przedmioty,Postac\Wiedzmin $wiedzmin){
               for($i=0; $i<count($przedmioty); $i++){
       $this->przedmioty+= $przedmioty[$i][nazwa]+$przedmioty[$i][param]+
                           $przedmioty[$i][cena]+'<input type="submit" value="kupuj">'; 
     }
     $this->wiedzmin=$wiedzmin;
     
     $this->wiedzmininfo=$this->wiedzmin->getGold+$this->wiedzmin->getName();
     $this->wyswietl=$this->wiedzmininfo+'<form action="index.php" method="POST">'+$this->przedmioty;
     
}
}