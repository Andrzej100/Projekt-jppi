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
    
    private $wiedzmin;
    
   
    public function __construct(Postac\Wiedzmin $wiedzmin){
        $this->wiedzmin=$wiedzmin;
    }
    
    public function dokupienia(){
        $db=bazadanych::getInstance();
        $wynik=$db->select('sklep');
        
        
        return $wynik;
    }
    public function dosprzedania(){
        $db=bazadanych::getInstance();
        $wynik=$db->select('ekwipunek');
      
        return $wynik;
    }
    public function kupno2($kupione){
        $posiadane=$this->dosprzedania();
        $zloto=$this->potrzebnezloto($kupione);
        if($this->wiedzmin->Getparam->getGold()>$zloto){
            $dokupienia=$this->nieposiadanerzeczy($kupione,$posiadane);
            $this->kupno($dokupienia);
            $this->wiedzmin->Getparam->setGold($this->wiedzmin->Getparam->getGold-$zloto);
            return true;
        }
        else{
            return false;
        }
    }
    public function sprzedarz2($sprzedane){
        $zloto=$this->potrzebnezloto($sprzedane);
        $this->sprzedarz($sprzedane);
        $this->wiedzmin->Getparam->setGold($this->wiedzmin->Getparam->getGold+$zloto);
    }
  // public function obsluga($transakcja){
      // $this->db=$this->db=bazadanych::getInstance();
     //  $this->transakcja=$transakcja;
      // if($this->transakcja=="sprzedaz"){
      // $this->wynik=$this->ekwipunek;
      // }elseif($this->transakcja=="kupno"){
     //  $this->wynik=$this->getPrzedmioty();
     //  }
      //for($i=0; $i<count($this->wynik); $i++){
     //  $this->przedmioty+= '<input type="checkbox" name="zaznaczone[]" value='.$this->wynik[$i]['id'].'>'+$this->wynik[$i]['nazwa']+$this->wynik[$i]['param']+
      //                     $this->wynik[$i][cena]+'<input type="submit" value='+$transakcja+'>'; 
     //  }
     //
    // $this->wiedzmininfo=$this->wiedzmin->getGold+$this->wiedzmin->getName();
    // $this->wyswietl=$this->wiedzmininfo+'<form action="index.php" method="POST">'+$this->przedmioty;
    // return $this->wyswietl;
//}
//public function transakcja($transakcja){
   // $this->db=$this->db=bazadanych::getInstance();
    //if($transakcja=="kupno"){
       // $zloto=$this->potrzebnezloto();
       // if($this->wiedzmin->getgold()>$zloto){
        // $this->nieposiadanerzeczy();
        // $this->kupno();
        // $this->wiedzmin->setGold($this->wiedzmin->getgold-$zloto);
        // return"zakupiono przedmioty";
    // }
    // else{
        // return "Nie masz wystarczajaco pieniendzy";
    // }
  // }
   // elseif($transakcja=="sprzedaz"){
    //    $zloto=$this->potrzebnezloto();
       // $this->sprzedarz();
      //  $this->wiedzmin->setGold($this->wiedzmin->getgold+$zloto);
      //  return "Sprzedano Przedmioty";
  //  }
    //else{return "Zly rodzaj transakcji";}
//}
public function kupno($dokupienia){
    $db=bazadanych::getInstance();
    foreach($dokupienia as $k){
        $db->zapisz('ekwipunek',array('nazwa'=>$k['nazwa'],'param1'=>$k['param1'],'param2'=>$k['param2'],'cena'=>$k['cena'],'id_postaci'=>$this->wiedzmin->Getparam->getId()));
       }  
     }
     public function sprzedarz($sprzedane){
         $db=bazadanych::getInstance();
         foreach($sprzedane as $p){
          $db->usun('ekwipunek',array('nazwa'=>$p['nazwa'],'id_postaci'=>$this->wiedzmin->Getparam->getId()));    
         }
     }

public function potrzebnezloto($produkty){
    foreach($produkty as $zaznaczone){
             $zloto+=$zaznaczone['cena'];
        }
     return $zloto;
}
public function nieposiadanerzeczy($kupione,$zaznaczone){
       foreach($kupione as $k){
           foreach($zaznaczone as $p){
               if($p['nazwa']==$k['nazwa']){
                   unset($zaznaczone[$p]);
               }
           }
       }
       array_values($zaznaczone);
       return $zaznaczone;
}
//public function getPrzedmioty(){
    //$sql= "select * from sklep ";
   // $query = $this->db ->prepare($sql);
   // $query -> execute();
   // $wynik=$query -> fetchAll();
   // return $wynik;
    
    
//}
}