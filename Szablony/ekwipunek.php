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
        <form action="index.php?strona=ekwipunek" method="POST">
            <select name="wybor">
                <?phpforeach($bronie as $bron){?>
                 <?phpif($bron['aktywne']==1){
                     
                     echo $bron['nazwa'].$bron['param1'].$bron['param2']."-aktywne";
                 }
                ?>
                <?phpif($bron['aktywne']==0){?>
                 <option value="<?php echo $bron['nazwa'];?>" > <?phpecho $bron['nazwa'].$bron['param1'].$bron['param2'];?></option>
                <?php}}?>
                </select>
                <input type="submit"  value="aktywuj ekwipunek"/>
        </form>
    </body>
</html>
