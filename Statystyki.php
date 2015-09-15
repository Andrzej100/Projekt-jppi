<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Statystyki
 *
 * @author andrzej.mroczek
 */
class Statystyki {
   
    
    
    public function statystykiform(){
        $statystyki=array('sila','zrecznosc','szybkosc','zycie');
        $form='<form action="index.php" method="POST">
                <input type="hidden" name="statystyki" value='+$statystyki[$i]+'>
                    <select name="staty">
                    <option value='+$statystyki[0]+'>'+$statystyki[0]+'</option>
                    <option value='+$statystyki[1]+'>'+$statystyki[1]+'</option>
                    <option value='+$statystyki[2]+'>'+$statystyki[2]+'</option>
                    <option value='+$statystyki[3]+'>'+$statystyki[3]+'</option>
                    </select>
               <input type="submit" value="statystyki">
                </form>';
        
        return $form;
    }
    public function statystykiwyswietl(){
        if(isset($_POST['statystyki'])){
            $param=$_POST['staty'];
            $sql= "select * from bohater";
        $query = $this->db -> prepare($sql);
        $query -> execute();
        $result = $query -> fetchAll();
        for($i=0; $i<count($result); $i++){
            $stat[$result[$i]['name']]=$result[$i][$param];
        }
        asort($stat);
        foreach ($stat as $key => $val) {
            $wynik+="$key = $val\n";
      
        }
        return $wynik;
            
        }
        return null;
    }
}



