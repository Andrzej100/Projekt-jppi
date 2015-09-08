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
    
    private $db;
    
    private $wynik;
   
    private $zaznaczone;
   public function obsluga($przedmioty,$transakcja,Postac\Wiedzmin $wiedzmin){ 
       $this->wynik=$przedmioty;
       for($i=0; $i<count($przedmioty); $i++){
       $this->przedmioty+= '<input type="checkbox" name="zaznaczone[]" value='.$przedmioty[$i][nazwa].'>'+$przedmioty[$i][nazwa]+$przedmioty[$i][param]+
                           $przedmioty[$i][cena]+'<input type="button" value='.$transakcja.'>'; 
     }
     $this->wiedzmin=$wiedzmin;
     
     $this->wiedzmininfo=$this->wiedzmin->getGold+$this->wiedzmin->getName();
     $this->wyswietl=$this->wiedzmininfo+'<form action="index.php" method="POST">'+$this->przedmioty;
     
}
public function transakcja(){
    if($this->getpost('submit')=="kupno"){
        $zloto=$this->potrzebnezloto();
        if($this->wiedzmin->getgold()>$zloto){
         $this->db=$this->db=bazadanych::getInstance();
         $this->nieposiadanerzeczy();
         $this->kupno();
         $this->wiedzmin->setGold($this->wiedzmin->getgold-$zloto);
     }
   }
    elseif($this->getpost('submit')=="sprzedaz"){
        $zloto=$this->potrzebnezloto();
        $this->db=$this->db=bazadanych::getInstance();
        $this->sprzedarz();
        $this->wiedzmin->setGold($this->wiedzmin->getgold+$zloto);
    }
}
public function kupno(){
    for($i=0; $i<count($this->wynik); $i++){
         $nazwa=$this->wynik[$i][nazwa];    
         $param=$this->wynik[$i][param]; 
         $sql="insert into ekwipunek ('nazwa','param') values(:nazwa,:param)";
         $query=$this->db-> prepare($sql);
         $this->result -> execute(array(":nazwa" => $nazwa,":param"=>$param));
             }
         
     }
     public function sprzedarz(){
         for($i=0; $i<count($this->wynik); $i++){
             $nazwa=$this->zaznaczone[$i][nazwa];
             $param=$this->zaznaczone[$i][param];
             $sql= 'DELETE FROM ekwipunek WHERE nazwa=:nazwa';
             $query=$this->db->prepare($sql);
             $query->execute(array(':nazwa' => $nazwa));
         }
     }

public function potrzebnezloto(){
    foreach($this->getpost('zaznaczone') as $zaznaczone){
        for($i=0; $i<cont($this->wynik); $i++){ 
        if($this->wynik[$i][nazwa]==$zaznaczone){
            $this->zaznaczone[]=$this->wynik[$i];
             $zloto+=$this->wynik[$i][cena];
         }
        }
     }
     return $zloto;
}
public function nieposiadanerzeczy(){
    $this->wynik="";
    $ekwipunek=$this->wiedzmin->getekwipunek();
       for($i=0; $i<count($this->zaznaczone); $i++){     
         for($j=0; $j<cont($ekwipunek); $j++){
         if($ekwipunek[$j][nazwa]==$this->zaznaczone[$i][nazwa]){
         $this->wynik[]=$this->zaznaczone[$i];
          }
         }    
         }
}
}