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
        <?php echo $message;?>
        <?php var_dump($sklep);?>
         Kupowanie
        <form action="index.php?strona=sklep" method="POST">
             <?php foreach($wynik as $p) { ?>
            <input type="checkbox" name="zaznaczone[]" value="<?php echo $p['nazwa'];?>">
            <?php echo $p['nazwa'].$p['param1'].$p['param2'].$p['cena'];?>
             <?php }?>
            <input type="submit" value="kup">
        </form>
         Sprzedawanie
        <form action="index.php?strona=sklep" method="POST">
            <?php foreach($wynik2 as $k) { ?>
            <input type="checkbox" name="zaznaczone[]" value="<?php echo $k['nazwa'];?>">
             <?php echo $k['nazwa'].$k['param1'].$k['param2'].$k['cena'];?>
            <?php }?>
            <input type="submit" value="sprzedaj">
        </form>
    </body>
</html>
