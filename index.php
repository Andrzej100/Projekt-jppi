<?php

//magincza fukcja autoloadera 
//
function __autoload($file) {

    include __DIR__.DIRECTORY_SEPARATOR.$file.'.php';

}

//error_reporting(E_ALL);
//ini_set('display_errors', 'On');
/**
 * Tworzy obiekt gra
 * Uruchamia gre wywołując funkcję Start
 */
$game = new Game();
$game->start();

