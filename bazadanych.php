<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of bazadanych
 *
 * @author andrzej.mroczek
 */
class bazadanych {

    private $pdo;
   
    private static $Instance = false;

    private function __construct() {
        $this->pdo= new PDO(
                'mysql:host=localhost;dbname=bazaprojekt',
                'Andrzej',
                'Andrzej27');
    }

    public static function getInstance() {
        if (self::$Instance == false) {
            self::$Instance = new bazadanych();
        }
        return self::$Instance;
    }

    private function __clone() {
        
    }

    public function getConnection() {
        return $this->pdo;
    }

 
}
