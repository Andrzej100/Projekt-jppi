<?php

//magincza fukcja autoloadera ...........
//
function __autoload($file) {

    include __DIR__.DIRECTORY_SEPARATOR.$file.'.php';

}

$game = new Game();
$game->start();

