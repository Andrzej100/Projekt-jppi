<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sesja
 *
 * @author andrzej.mroczek
 */
class sesja extends request {
    
    
    private $login;
    
    private $haslo;
    
    private $db;
    
    private $result;
    
    private $formularz;
   
    
    public function formylarz($typ){
        $this->formularz='<form action="index.php" method="POST"> 
               <input type="text" name="login"/>
               <input type="password" name="haslo">
               <input type="button" vlaue="$typ"> 
              </form>';
         return $this->formularz;
    }
    public function formularz2(){
       
    for($i=0; $i<count($this->result); $i++){
        $postac+='<label><input type="hidden" name="nazwa" value='+$this->result[$i][nazwa]+' />'
                +$this->result[$i][nazwa]+'</label><label>'+$this->result[$i][poziom]+
                '<input type="button" vlaue="wybierz">';
    }
    $this->formularz='<form action="index.php" method="POST">'+$postac;
    }
    
     public function rejestracja(){
        if( $this->getpost('login')  &&  $this->getpost('haslo') ) {
            $sila=1; $zrecznosc=1; $szybkosc=1; $zycie=1;
            $login=$this->getpost('login'); $haslo=$this->getpost('haslo');
           $this->db=bazadanych::getInstance();
           $sql="insert into user ('user_name', 'user_password', 'sila', 'zrecznosc','szybkosc','zycie') values (:login, :haslo,:sila,:zrecznosc,:szybkosc,:zycie)";
           $query=$this->db -> getConnection() -> prepare($sql);
           $this->result-> execute(array(":login" => $user_name, ":haslo" => $user_password, ":sila" => $sila, ":zrecznosc" => $zrecznosc,":szybkosc"=>$szybkosc,":zycie"=>$zycie));
           }
    }
    public function login(){
        $login = filter_input(INPUT_POST, 'login');
        
        $data = $_POST['data'];
        
         if( $this->getpost('login')  &&  $this->getpost('haslo') ) {
        $login=$this->getpost('login');
        $this->login=$login;
        $haslo=$this->getpost('haslo');
        $this->db=bazadanych::getInstance();
        $sql= "select * from user where 'user_name' = $login AND 'user_password'= $haslo";
        $query = $this->db -> getConnection() -> prepare($sql);
        $query -> execute(array($user_name,$user_password)); 
        $this->result = $query -> fetchAll();}
        if($this->result){
            $this->start;
            $this->getsession('result')=$this->result;
        }
         else{
         return false;
    }
}
public function wybierzpostac(){
   if(!isset($this->getpost('wybierz'))){
    $this->db=bazadanych::getInstance();
    $login=$this->login;
    $sql= "select * from postac where 'user_name' = $login";
    $query = $this->db -> getConnection() -> prepare($sql);
    $query -> execute(array($user_name));
    $this->result = $query -> fetchAll();
    $this->formularz2();
   }
    if(isset($this->getpost('wybierz'))){
    $this->db=bazadanych::getInstance();
    $login=$this->login;
    $nazwa=$this->getpost('nazwa');
    $sql= "select * from postac where 'nazwa' = $nazwa AND 'user_name'=$login";
    $query = $this->db -> getConnection() -> prepare($sql);
    $query -> execute(array($nazwa,$user_name));
    $this->result = $query -> fetchAll();
    return $this->result;
    }
}
  public function start(){
      session_start();
  }
  public function logout(){
      session_unset();
      session_destroy(); 
  }
  
}