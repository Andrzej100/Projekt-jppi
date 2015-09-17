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

    private $ekwipunek;
    
    private $aktywne;
    
    private $db;
    
    private $bohater_id;

    public function __construct($aktywne,$bohater_id) {

        $this->aktywne=$aktywne;
        $this->bohater_id=$bohater_id;
    }

    public function dodajdo_ekwipunku($przedmiot){
         $this->db=bazadanych::getInstance();
         $nazwa=$przedmiot[0][nazwa];
         $typ=$przedmiot[0][typ];
         $param1=$przedmiot[0][param1];
         $param2=$przedmiot[0][param2];
         $cena=$przedmiot[0][cena];
         $bohater_id=$this->bohater_id;
         $sql="insert into ekwipunek ('bohater_id', 'nazwa', 'typ', 'param1','param2','cena') values (:bohater_id, :nazwa,:typ,:param1,:param2,:cena)";
         $query=$this->db ->prepare($sql);
         $query-> execute(array(":bohater_id" => $bohater_id, ":nazwa" => $nazwa, ":typ" => $typ, ":param1" => $param1, ":param2"=>$param2, ":cena"=>$cena));
    }
    
    public function aktywnyekwipunek($przedmiotid){
         $this->db=bazadanych::getInstance();
         $przedmiot=$this->getekwpunekbyid($przedmiotid);
         if($przedmiot[0][typ]=='bron'){
             $bron=new bron($przedmiot);
             return $bron;
         }elseif($przedmiot[0][typ]=='zbroja'){
             $zbroja=new zbroja($przedmiot);
             return $zbroja;
         }
    }
    
    public function wyposazone($i){
        if(issest($this->aktywne)){
        if($this->ekwipunek[$i][id]==$this->saktywne[0]){
            return 'Aktywna Bron';
        }
        elseif($this->ekwipunek[$i][id]==$this->aktywne[1]){
            return 'Aktywna Zbroja';
        }
        else{
            return '<input type="submit" value="wyposaz"/>';
        }
        }
    }

    public function showekwipunek() {
        $this->getekwpunek();
        if ($this->ekwipunek != null) {
            for ($i = 0; $i < count($this->ekwipunek); $i++) {
                $wynik +='<form action="index.php" method="POST">'+$this->ekwipunek[$i][name] + ' '
                + $this->ekwipunek[$i][param1] +' '+$this->ekwipunek[$i][param2]+'<input type="hidden" name="idbroni" value='+$this->ekwipunek[$i][id]+'/>'+
        $this->wyposazone($i)+ '/n';
            }
        }
         return $wynik;
    }
    
    public function getekwpunekbyid($id){
        $bohater_id=$this->bohater_id; 
        $id_ekwipunek=$id;
         $sql= "select * from ekwipunek where 'bohater_id'=$bohater_id AND 'id_ekwipunek'=$id_ekwipunek";
         $query = $this->db->prepare($sql);
         $query -> execute(array($id_ekwipunek,$bohater_id));
         $ekwipunek = $query -> fetchAll();
         return $ekwipunek;
    }
    public function getekwpunek(){
         $bohater_id=$this->bohater_id;
         $this->db=bazadanych::getInstance();
         $sql= "select * from ekwipunek where bohater_id=$bohater_id";
         $query = $this->db ->prepare($sql);
         $query -> execute(array($bohater_id));
         $this->ekwipunek = $query -> fetchAll();
    }
   

}
