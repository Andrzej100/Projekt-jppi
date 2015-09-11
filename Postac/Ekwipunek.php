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

    public function __construct($aktywne) {

        $this->aktywne($aktywne);
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
    
    public function aktywne() {
        if (isset($this->getpost('wyposaz'))) {
            if ($this->ekwipunek[0][typ] == 'bron') {
                $this->bron = new Bron($this->ekwipunek[0][nazwa],$this->ekwipunek[0][param1],$this->ekwipunek[0][param2]);
            }
            if ($this->ekwipunek[0][typ] == 'zbroja') {
                $this->zbroja = new Zbroja($this->ekwipunek[0][nazwa],$this->ekwipunek[0][param1],$this->ekwipunek[0][param2]);
            }
        }
    }

    public function showekwipunek($ekwipunek) {
        if ($ekwipunek != null) {
            for ($i = 0; $i < count($ekwipunek); $i++) {
                $ekwipunek +='<form action="index.php" method="POST">'+$this->ekwipunek[$i][name] + ' '
                + $ekwipunek[$i][param1] +' '+$ekwipunek[$i][param2]+'<input type="button" value="wyposaz"/>'+ '/n';
            }
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
