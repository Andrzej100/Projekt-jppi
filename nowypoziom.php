<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of nowypoziom
 *
 * @author andrzej.mroczek
 */
class Nowypoziom {
    private $poziom=array(1=>3,2=>6,3=>12,4=>24,5=>48);
    
    private $dosw;
    
    private $id;
    
    private $punktystatystyk; 
    
    private $db;
    
    private $result;
    
    public function __construct($id_postaci) {
        $this->id=$id_postaci;
    }
   
    public function setpoziom($dosw){
        for($i=1; $i<count($this->poziom); $i++){
            if($dosw<$this->poziom[$i]){
                $poziom=$this->poziom[$i];
            }
        }
        return $poziom;
    }
    
    public function getdosw($bohater_id,$potw_poziom){
        $this->db=bazadanych::getInstance();
        $sql= "select * from poziom where 'bohater_id' = $bohater_id";
        $query = $this->db -> prepare($sql);
        $query -> execute(array($bohater_id));
        $this->result = $query -> fetchAll();
        $dosw=$this->result[0][dosw]+$potw_poziom;
        $poziom=$this->setpoziom($dosw);
        if($poziom>$this->result[0][poziom]){
           $punkty=$this->result[0][punkty]+3;
           $sql="UPDATE poziom SET dosw=:dosw , poziom=:poziom , punkty=:punkty WHERE bohater_id=:bohater_id";
           $query= $query = $this->db -> prepare($sql);
           $query -> execute(array($dosw,$poziom,$punkty,$bohater_id));
         }
         else{
          $sql="UPDATE poziom SET dosw=:dosw WHERE bohater_id=:bohater_id";
          $query= $query = $this->db -> prepare($sql);
          $query -> execute(array($dosw,$bohater_id));
         }
    }
    public function form($param){
       $form='<form action="index.php" methos="POST">
              <input type="hidden" name="stat" value='+$param+'>
              Sila: <input type="submit" value="+">';
       return $form;
    }
    public function getpunktydorozdania($bohater){
        $this->db=bazadanych::getInstance();
        $bohater_id=$bohater[0][id];
        $sql= "select * from poziom where 'bohater_id' = $bohater_id";
        $query = $this->db -> prepare($sql);
        $query -> execute(array($bohater_id));
        $this->result = $query -> fetchAll();
        $this->obsluga($bohater);
        if($this->result[0][punkty]>0){
            $form="sila:"+$this->form('sila')+
                   "zrecznosc"+$this->form('zrecznosc')+
                   "szybkosc"+$this->form('szybkosc')+
                    "zycie"+$this->form('zycie');
            return $form;
           }
    }
    public function zapytania($stat,$bohater_id,$param){
       if($stat=='sila'){   
       $sql="UPDATE bohater SET sila=:param WHERE bohater_id=:bohater_id";
       $query= $query = $this->db -> prepare($sql);
       $query -> execute(array($sila,$bohater_id));
       }
       elseif($stat=='zrecznosc'){   
       $sql="UPDATE bohater SET zrecznosc=:param WHERE bohater_id=:bohater_id";
       $query= $query = $this->db -> prepare($sql);
       $query -> execute(array($zrecznosc,$bohater_id));    
       }
       elseif($stat=='szybkosc'){   
       $sql="UPDATE bohater SET szybkosc=:param WHERE bohater_id=:bohater_id";
       $query= $query = $this->db -> prepare($sql);
       $query -> execute(array($szybkosc,$bohater_id));    
       }
       elseif($stat=='zycie'){   
       $sql="UPDATE bohater SET zycie=:param WHERE bohater_id=:bohater_id";
       $query= $query = $this->db -> prepare($sql);
       $query -> execute(array($zycie,$bohater_id));    
       }
    }
    public function obsluga($bohater){
        if(isset($_POST['stat'])){
            $stat=$_POST['stat'];
            $punkty=$this->result[0][punkty]-1;
            $sql="UPDATE poziom SET punkty=:punkty WHERE bohater_id=:bohater_id";
            $query= $query = $this->db -> prepare($sql);
            $query -> execute(array($punkty,$bohater_id));
            $param=$bohater[0][$stat]+1; 
            $bohater_id=$bohater[0][id];
            $this->zapytania($stat,$bohater_id,$param);
        }
    }
    
}
