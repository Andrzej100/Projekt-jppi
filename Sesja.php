<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sesja2
 *
 * @author Andrzej
 */
class Sesja {
    
    private static $session = false;

    public static function getInstance() {
        if(self::$session == false){
            self::$session = new Sesja();
        }
        return  self::$session;
    }
    
    public function __construct() {
        session_start();
    }
    
    public function setUp($data) {
        if(empty($_SESSION['app'])){
            $_SESSION['app']=$data;
        }else{
            $this->append($data);
        }    
    }
    
    private function append($data){
        foreach($data as $key=>$row){
            $_SESSION['app'][$key] = $row;
        }
    }
    
    public function debug() {
        var_dump($_SESSION);
    }
    
    public function delete($key){
        unset($_SESSION['app'][$key]);
    }
    
    public function setMessage($message) {
        $_SESSION['system']['message'] = $message;
    }
    
    public function getMessage() {
        $message = '';
        if(!empty($_SESSION['system']['message'])){
            $message = $_SESSION['system']['message'];
            unset($_SESSION['system']['message']);
        }

            
        return $message;
    }
    
    public function get($key) {
        if(empty($_SESSION)){
            return null;
        }
        if(isset($_SESSION['app'][$key])){
            return $_SESSION['app'][$key];
        }
        return false;   
    }
    
    public function destroy() {
        session_destroy();
    }
    
    
//    private $session;
//    
//    
//    
//
//    public function sessionstart() {
//        if ($this->session == true) {
//            session_start();
//        }
//    }
//
//    public function sessionset() {
//        $this->session = true;
//    }
//
//    public function sessionclose() {
//        session_unset();
//        session_destroy();
//    }

}
