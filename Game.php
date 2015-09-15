<?php

/**
 * Description of Game
 *
 * @author piotr.switala <piotr.switala@powiat.poznan.pl>
 */
class Game extends request {
   
private $session;
    /**
     * Obsługa głównego wątku gry
     */
    public function start() {
        $this->sessionstart();
          if(!isset($_POST['submit'])){ 
       echo"Czychcesz sie zarejestrować czy zalogować?";
          echo $this->wybor();
          }
          elseif(isset($_POST['rejestracja'])){
              $sesja=new sesja();
              echo $sesja->formularz("rejestracja");
              if($sesja->rejestracja()==true){
                  echo"Rejestracja zakonczona pomyslnie";
                  echo"Czychcesz sie zarejestrować czy zalogować?";
                 echo $this->wybor();
              }
          }
          elseif(isset($_POST['logowanie'])){
              $sesja=new sesja();
              echo $sesja->formularz("logowanie");
              if($sesja->login()==true){
                  echo"Logowanie zakonczone pomyslnie";
                  $this->session=true;
               echo $sesja->wybierzpostac();
              }
          }
       if($_POST['submit']=="wybierz"){
            $sesja=new sesja();
            $wybor=$sesja->wyborpostaci();
            $postac= new Wiedźmin($wybor);
            echo 'wybrales'+$sesja->wyborpostaci();
            
           }
        if($_POST['submit']=='Statystyki'){
            $statystyki= new Statystyki();
            echo $statystyki->statystykiform();
            if(isset($_POST['staty'])){
                $statystyki->statystykiwyswietl();
            }
        }
        elseif($_POST['submit']=='Wybierz Ekwipunek'){
            $ekwipunek=new Ekwipunek($_SESSION['posatac'][0]['id'],$aktywne);
            echo $ekwipunek->showekwipunek();
            if($_POST['submit']=='wyposaz'){
                $wiedzmin=new wiedzmin();
                $bron=$ekwipunek->getbron($_POST['idbroni']);
                $wiedzmin->aktywnyEkwipunek($bron);
            }
        }
        elseif($_POST['submit']=='Wybierz Przeciwnika'){
            if(isset($_POST['potwor']) || $_POST['submit']=="Wybierz akcje" ){
                $przeciwnik=$_POST['potwor'];           
                $potwor= new Postac\Potwor($przeciwnik);
                $tura = new Tura();
                $tura->dodajGracza($postac);
                $tura->dodajPrzeciwnika($potwor);
                $tura->akcja(null);
            }else{echo $this->wyborprzeciwnika();}
        }
        if($_POST['submit']=="Wybierz akcje"){
            do {
                if($_POST['akcja']==''){$_POST['akcja']=null;}
                $opcja=$_POST['akcja'];
                $tura->akcja($opcja);
                $this->wyborruchu();
           
        } while ($tura->sprawdzCzyKoniec());
        }
        
        
    }
    public function wybor(){
      return  '<form action="index.php" method="POST"> 
               <input type="hidden" name="rejestracja" value="true"/>
               <input type="submit" vlaue="rejsetracja"> 
              </form>
        <form action="index.php" method="POST"> 
               <input type="hidden" name="logowanie" value="true"/>
               <input type="submit" vlaue="logowanie"> 
              </form>';
    }
 
    public function sessionstart(){
    if($this->session==true){
      session_start();
     }
    }
    public function wyborakcji() {
       
        return  '<form action="index.php" method="POST>
               <input type="submit" vlaue="Wybierz Ekwipunek">
               <input type="submit" vlaue="Statystyki">
               <input type="submit" vlaue="Wybierz Przeciwnika"> 
              </form>';
    }
    public function wyborprzeciwnika(){
         return  '<form action="index.php" method="POST>
                  <select name="potwor">
                    <option value="potwor1">Potwor1</option>
                    <option value="potwor2">Potwor2</option>
                    <option value="potwor3">Potwor3</option>
                    <option value="potwor4">Potwor4</option>
                    <option value="potwor5">Potwor5</option>
                    </select>
                    <input type="submit" value="Wybierz Przeciwnika">
              </form>';
    }
    
    
     
}
