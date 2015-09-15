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
    private $bron;
    private $zbroja;
    private $db;
    private $result;
    private $bohater_id;

    public function __construct($aktywne,$bohater_id) {

        $this->aktywne=$aktywne;
        $this->bohater_id=$bohater_id;
    }

    public function dodajdo_ekwipunku($przedmiot,$name){
         $this->db=bazadanych::getInstance();
         $nazwa=$przedmiot[0][nazwa];
         $typ=$przedmiot[0][typ];
         $param1=$przedmiot[0][param1];
         $param2=$przedmiot[0][param2];
         $cena=$przedmiot[0][cena];
         $sql="insert into ekwipunek ('user_name', 'nazwa', 'typ', 'param1','param2','cena') values (:name, :nazwa,:typ,:param1,:param2,:cena)";
         $query=$this->db -> getConnection() -> prepare($sql);
         $this->result-> execute(array(":name" => $user_name, ":nazwa" => $nazwa, ":typ" => $typ, ":param1" => $param1, ":param2"=>$param2, ":cena"=>$cena));
    }
    
    

    public function showekwipunek() {
        if ($this->ekwipunek != null) {
            for ($i = 0; $i < count($ekwipunek); $i++) {
                $wynik +='<form action="index.php" method="POST">'+$this->ekwipunek[$i][name] + ' '
                + $ekwipunek[$i][param1] +' '+$ekwipunek[$i][param2]+'<input type="hidden" name="idbroni" value='+$this->ekwipunek[$i][id]+'/>'+
        '<input type="submit" value="wyposaz"/>'+ '/n';
            }
        }
         return $wynik;
    }
    public function getbron($id){
         for ($i = 0; $i < count($ekwipunek); $i++) {
             if($this->ekwipunek[$i][id]==$id){
             $wynik=$this->ekwipunek[$i];
          }  
          return $wynik;
       }
    }
    
    
    public function getekwpunek(){
         $this->db=bazadanych::getInstance();
         $sql= "select * from ekwipunek";
         $query = $this->db -> getConnection() -> prepare($sql);
         $query -> execute();
         $this->ekwipunek = $query -> fetchAll();
    }
   

}
