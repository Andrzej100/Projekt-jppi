<?php

/**
 * Statyczna Klasa console wyświetla komunikaty i pobiera dane z bufora
 */
class Console
{
    /**
     * Wyświetla tekst w konsoli
     *
     * @param String $tekst
     */
    public static function write($tekst)
    {
        $stdout = fopen('php://stdout', 'w');
        fwrite($stdout, $tekst."\n");
        fclose($stdout);
    }


    /**
     * Pobiera dane z bufora
     * (cała linia do znaku enter)
     *
     * @return String
     */
    public static function read()
    {
        $stdin = fopen('php://stdin', 'r');

        $input = fgets($stdin);
        
        //substring usunięcie znaków nowej lini
        return substr($input, 0, -2);
    }
    
}
