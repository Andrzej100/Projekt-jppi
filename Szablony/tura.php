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
          <?php if(!isset($_POST['wybor'])){ ?>
          <?php echo $message; ?>
        <form action="index.php?strona=tura" method="POST">
        <input type="submit"  value="rozpocznij gre"/>
        </form>
    <?php }?>
        <?php if(isset($_POST['wybor'])){ ?>
        <?php echo $message; ?>
        <form action="index.php?strona=tura" method="POST">
            <select name="wybor">
                 <option value="a" >atak</option>
                 <option value="b" >utworz eliksir</option>
                 <option value="c" >wypij eliksir</option>
                 <option value="d" >obrona(konczy ture)</option>
                 <option value="e" >koniec tury</option>
            </select>
            <input type="submit"  value="wybierz ruch"/>
        </form>
    <?php }?>
      <?php if($wynik4[0]){ ?>
        <form action="index.php?strona=przeciwnik" method="POST">
        <input type="submit"  value="do wybor przeciwnika"/>
        </form>
        
        <?php if($wynik4[1]){ ?>
         <form action="index.php?strona=nowypoziom" method="POST">
        <input type="submit"  value="nowy poziom rozdaj punkty"/>
        </form>
        <?php }?> 
      <?php }?> 
    </body>
</html>
