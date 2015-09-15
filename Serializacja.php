<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Serializacja
 *
 * @author Andrzej
 */
class Serializacja {

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of Serializacja
 *
 * @author andrzej.mroczek
 */

    
    private $sreialized;
    
    private $name;
    
    private $unserialized;
    
 public function serialize($object,$name){
    $serializing=serialize($object);
    $this->name=$name;
    $this->serialized=$serializing;
}
public function serialized($user_id, $update = false){
    $name=$this->name;
    $serialized=$this->serialized;
    $this->db=bazadanych::getInstance();
    if($update == false) {
        $sql="insert into serializacja ('user_id', 'serialized','name') values (:user_id, :serialized, :name)";
        $query=$this->db -> getConnection() -> prepare($sql);
        $query-> execute(array(":user_id" => $user_id, ":serialized" => $serialized, ":name"=>$name));
        
    }else {
        $sql="UPDATE serializacja SET serialized=:serialized name=:name WHERE user_id=:user_id AND name=:name";
        $query= $query = $this->db -> prepare($sql);
        $query -> execute(array($serialized,$name,$user_id));
    }
}
public function unserialize($user_id,$name){
    $sql= "select * from serializacja where 'user_id' = $user_id AND 'name'=$name";
    $query = $this->db -> prepare($sql);
    $query -> execute(array($user_id,$name));
    $this->unserialized = $query -> fetchAll();
}
public function getObject($name){
 
    $name=unserialize($this->unserialized[0]['serialized']);
          return $name;  
        
 }
}
