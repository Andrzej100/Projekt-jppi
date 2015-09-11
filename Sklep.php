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
    
    private $result;
    
    private $posiadane;
    
   public function obsluga($przedmioty,$transakcja,Postac\Wiedzmin $wiedzmin){
       if($przedmioty==null){
       $sql= "select * from ekwipunek";
       $query = $this->db -> prepare($sql);
       $query -> execute();
       $this->wynik=$query -> fetchAll();
       }else{
       $this->wynik=$przedmioty;
       }
       $this->wiedzmin=$wiedzmin;
       $this->transakcja();
       for($i=0; $i<count($przedmioty); $i++){
       $this->przedmioty+= '<input type="checkbox" name="zaznaczone[]" value='.$przedmioty[$i]['nazwa'].'>'+$przedmioty[$i]['nazwa']+$przedmioty[$i]['param']+
                           $przedmioty[$i][cena]+'<input type="button" value='.$transakcja.'>'; 
       }
     
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
    for($i=0; $i<count($this->posiadane); $i++){
         $id=$this->wiedzmin[0][id];
         $nazwa=$this->posiadane[$i]['nazwa'];    
         $typ=$this->posiadane[$i]['typ'];
         $param1=$this->posiadane[$i]['param1'];
         $param2=$this->posiadane[$i]['param2'];
         $cena=$this->posiadane[$i]['cena']; 
         $sql="insert into ekwipunek ('user_id', 'nazwa', 'typ', 'param1','param2','cena') values (:id, :nazwa,:typ,:param1,:param2,:cena)";
         $query=$this->db -> getConnection() -> prepare($sql);
         $this->result-> execute(array(":id" => $user_id, ":nazwa" => $nazwa, ":typ" => $typ, ":param1" => $param1, ":param2"=>$param2, ":cena"=>$cena));
             }
         
     }
     public function sprzedarz(){
         for($i=0; $i<count($this->wynik); $i++){
             $id=$this->wiedzmin[0]['id'];
             $nazwa=$this->zaznaczone[$i]['nazwa'];
             $sql= 'DELETE FROM ekwipunek WHERE nazwa=:nazwa AND user_id=:id';
             $query=$this->db->prepare($sql);
             $query->execute(array(':nazwa' => $nazwa,':id'=>$user_id));
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
    $ekwipunek=$this->wiedzmin->getekwipunek();
       for($i=0; $i<count($this->zaznaczone); $i++){     
         for($j=0; $j<cont($ekwipunek); $j++){
         if($ekwipunek[$j][nazwa]==$this->zaznaczone[$i][nazwa]){
         $this->$posiadane[]=$this->zaznaczone[$i];
          }
         }    
         }
}
}