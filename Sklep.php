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
    
    private $posiadane;
    
    private $ekwipunek;
    
    private $transakcja;
    
    public function __construct(Postac\Wiedzmin $wiedzmin){
        $this->wiedzmin=$wiedzmin;
        $this->ekwipunek=$this->wiedzmin->getekwipunek();
    }
    
   public function obsluga($transakcja){
       $this->db=$this->db=bazadanych::getInstance();
       $this->transakcja=$transakcja;
       if($this->transakcja=="sprzedaz"){
       $this->wynik=$this->ekwipunek;
       }elseif($this->transakcja=="kupno"){
       $this->wynik=$this->getPrzedmioty();
       }
       for($i=0; $i<count($this->wynik); $i++){
       $this->przedmioty+= '<input type="checkbox" name="zaznaczone[]" value='.$this->wynik[$i]['id'].'>'+$this->wynik[$i]['nazwa']+$this->wynik[$i]['param']+
                           $this->wynik[$i][cena]+'<input type="submit" value='+$transakcja+'>'; 
       }
     
     $this->wiedzmininfo=$this->wiedzmin->getGold+$this->wiedzmin->getName();
     $this->wyswietl=$this->wiedzmininfo+'<form action="index.php" method="POST">'+$this->przedmioty;
     return $this->wyswietl;
}
public function transakcja($transakcja){
    $this->db=$this->db=bazadanych::getInstance();
    if($transakcja=="kupno"){
        $zloto=$this->potrzebnezloto();
        if($this->wiedzmin->getgold()>$zloto){
         $this->nieposiadanerzeczy();
         $this->kupno();
         $this->wiedzmin->setGold($this->wiedzmin->getgold-$zloto);
         return"zakupiono przedmioty";
     }
     else{
         return "Nie masz wystarczajaco pieniendzy";
     }
   }
    elseif($transakcja=="sprzedaz"){
        $zloto=$this->potrzebnezloto();
        $this->sprzedarz();
        $this->wiedzmin->setGold($this->wiedzmin->getgold+$zloto);
        return "Sprzedano Przedmioty";
    }
    else{return "Zly rodzaj transakcji";}
}
public function kupno(){
    for($i=0; $i<count($this->posiadane); $i++){
         $bohater_id=$this->wiedzmin[0][id];
         $nazwa=$this->zaznaczone[$i]['nazwa'];    
         $typ=$this->zaznaczone[$i]['typ'];
         $param1=$this->zaznaczone[$i]['param1'];
         $param2=$this->zaznaczone[$i]['param2'];
         $cena=$this->zaznaczone[$i]['cena']; 
         $sql="insert into ekwipunek ('bohater_id', 'nazwa', 'typ', 'param1','param2','cena') values (:bohater_id, :nazwa,:typ,:param1,:param2,:cena)";
         $query=$this->db-> prepare($sql);
         $query-> execute(array("bohater_id" => $bohater_id, ":nazwa" => $nazwa, ":typ" => $typ, ":param1" => $param1, ":param2"=>$param2, ":cena"=>$cena));
             }
         
     }
     public function sprzedarz(){
         for($i=0; $i<count($this->zaznaczone); $i++){
             $bohater_id=$this->wiedzmin[0]['id'];
             $nazwa=$this->zaznaczone[$i]['nazwa'];
             $sql= 'DELETE FROM ekwipunek WHERE nazwa=:nazwa AND bohater_id=:bohater_id';
             $query=$this->db->prepare($sql);
             $query->execute(array(':nazwa' => $nazwa,':bohater_id'=>$bohater_id));
         }
     }

public function potrzebnezloto(){
    foreach($this->getpost('zaznaczone') as $zaznaczone){
        for($i=0; $i<cont($this->wynik); $i++){ 
        if($this->wynik[$i]['id']==$zaznaczone){
            $this->zaznaczone[]=$this->wynik[$i];
             $zloto+=$this->wynik[$i][cena];
         }
        }
     }
     return $zloto;
}
public function nieposiadanerzeczy(){
       for($i=0; $i<count($this->zaznaczone); $i++){     
         for($j=0; $j<count($this->ekwipunek); $j++){
         if($this->ekwipunek[$j][nazwa]==$this->zaznaczone[$i][nazwa]){
             $this->posiadane[]=$this->zaznaczone[$i];
             unset($this->zaznaczone[$i]);
             $this->zaznaczone=array_values($this->zaznaczone);
          }
         }    
         }
}
public function getPrzedmioty(){
    $sql= "select * from sklep ";
    $query = $this->db ->prepare($sql);
    $query -> execute();
    $wynik=$query -> fetchAll();
    return $wynik;
    
    
}
}