<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php echo $message; ?>
        <?php echo $punkty; ?>
        <form action="index.php?strona=nowypoziom" method="POST">
            Sila<?php echo $wynik[0]; ?><input type="submit"  name="wybor" value="+1 Sila"/>
            Szybkosc<?php echo $wynik[1]; ?><input type="submit"  name="wybor" value="+1 Szybkosc"/>
            Zrecznosc<?php echo $wynik[2]; ?><input type="submit"  name="wybor" value="+1 Zrecznosc"/>
            Zycie<?php echo $wynik[3]; ?><input type="submit"  name="wybor" value="+1 Zycie"/>
        </form>
         <form action="index.php?strona=przeciwnik" method="GET">
             <input type="hidden" name="unset" value="nowypoziom">
             <input type="submit"  name="cofnij" value="doprzeciwnika"/>
         </form>
    </body>
</html>
