<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ekwipunek
 *
 * @author andrzej.mroczek
 */
class Ekwipunek {

  
    private $bohater_id;

    public function __construct($bohater_id) {

        $this->bohater_id=$bohater_id;
    }
     
    public function aktywne(){
        $db = bazadanych::getInstance();
        $wynik=$db->select('ekwipunek',array('aktywne'=>1,'postac_id'=>$this->bohater_id));
         if($wynik == false){
            return false;
        }
        
        return $wynik;
    }
    
    public function bron($aktywne,$nazwa){
        foreach($aktywne as $a){
            if($a['nazwa']==$nazwa){
                $aktywna=$a;
            }
        }
        return $a;
    }
    
    public function aktywuj($nazwa){
        $db = bazadanych::getInstance();
        $aktywne=$this->aktywne();
        $bron=$this->bron($aktywne, $nazwa);
        if($aktywne[0]['typ']==$bron['typ']){
         $db->update('ekwipunek',array('aktywne'=>0),array('nazwa'=>$aktywne[0]['nazwa'],'postac_id'=>$this->bohater_id));
         $db->update('ekwipunek',array('aktywne'=>1),array('nazwa'=>$nazwa,'postac_id'=>$this->bohater_id));
        }elseif($aktywne[1]['typ']==$bron['typ']){
         $db->update('ekwipunek',array('aktywne'=>0),array('nazwa'=>$aktywne[1]['nazwa'],'postac_id'=>$this->bohater_id));
         $db->update('ekwipunek',array('aktywne'=>1),array('nazwa'=>$nazwa,'postac_id'=>$this->bohater_id));
        }elseif($aktywne==false){
           $db->update('ekwipunek',array('aktywne'=>1),array('nazwa'=>$nazwa,'postac_id'=>$this->bohater_id)); 
        }
        
    }
  
    public function aktywnabron($typ){
         $db = bazadanych::getInstance();
         $przedmiot=$this->aktywne();
         if($przedmiot!=false){
         if($przedmiot[0]['typ']==$typ){
             $bron=new $typ($przedmiot);
             return $bron;
         }elseif($przedmiot[1]['typ']==$typ){
             $bron=new $typ($przedmiot);
             return $bron;
         }
       }else{
           return false;
       }
    }
    
   
  

    public function showekwipunek() {
       
        $db=bazadanych::getInstance();
        $wynik=$db->select('ekwipunek',array('postac_id'=>$this->bohater_id));
      
        return $wynik;
        
    }
    
    
    
   

}
