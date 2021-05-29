<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Castle Plansza </title>
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=MedievalSharp&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/gra.css">
</head>

  
<body>
    
    
    <header>
        <div class="baner">
            -Castle-
        </div>
        <div class="navigation">
        
            <div class="right">   
                
            <div  id="nav-hover" >
                <a href="#">Moje konto</a>
                    
                        <ul>
                            <li><a href="plansza.php">Odśwież</a></li>
                            <li><a href="#">Zmien haslo</a></li>
                        </ul>
               </div>
                <div class="main-button"> <a href='login.php?akcja=wyloguj' >Wyloguj</a></div>
                
        </div>
            </div>
        </header>
   
   <div class=main>
    <div class="plansza-tlo">
        <div class="plansza-biala">
      <div class="plansza-pasek">
          <div class="plansza-pasek-lewo">
          <a href="#">Pracuj</a>
                    
                        <ul>
                            <li><a href="plansza.php?akcja=Kopalnia">Kopalnia-czas: 5s</a></li>
                           <!-- <li><form action="plansza.php" method="get"><input type="submit" name="akcja" value="Kopalnia" ></form></li>-->
                            <li><a href="plansza.php?akcja=Las">Las-czas: 3s</a></li>
                            Powiadomienia:
                            <li>
                                <?php
                                include_once("plansza-dzialanie.php");
                                echo "";
                                $akcja="";
                                if (filter_input(INPUT_GET, "akcja")=="Kopalnia") {
                                praca($login,$gold,$db,'kopalnia');
                                 header("location: plansza.php");
                                }
                                if (filter_input(INPUT_GET, "akcja")=="Las") {
                                praca($login,$gold,$db,'las');
                                 header("location: plansza.php");
                                }
                                ?>
                            </li>
                        </ul>
              
          </div>
          <div class="plansza-pasek-srodek">  
          <?php
           
        wyswietl($login,$gold);
        
?>
              </div>
          <div class="plansza-pasek-prawo">
             <a href="#">Buduj</a>
                    
                        <ul>
                            <li><a href="plansza.php?akcja=budujDomPoz1">Buduj dom poz1 - koszt 200$</a></li>
                            <li><a href="plansza.php?akcja=budujDomPoz2">Buduj dom poz2 - koszt 200$</a></li>
                            <li><a href="plansza.php?akcja=budujDomPoz3">Buduj dom poz3 - koszt 200$</a></li>
                            <li><a href="plansza.php?akcja=budujDomPoz4">Buduj dom poz4 - koszt 200$</a></li>
                            <li><a href="plansza.php?akcja=budujMur">Buduj mur - koszt 500$</a></li>
                             Powiadomienia:
                            
                                
                                    <?php
                                include_once("plansza-dzialanie.php");
                                echo "";
                                $akcja="";
                                
                                if (filter_input(INPUT_GET, "akcja")=="budujMur") {
                                
                                 buduj($login,$gold,$db,$mur,"mur");
                                }
                                if (filter_input(INPUT_GET, "akcja")=="budujDomPoz1") {
                                buduj($login,$gold,$db,$poz1,"poz1");
                                 
                                }
                                if (filter_input(INPUT_GET, "akcja")=="budujDomPoz2") {
                               
                                 buduj($login,$gold,$db,$poz2,"poz2");
                                }
                                if (filter_input(INPUT_GET, "akcja")=="budujDomPoz3") {
                               
                                 buduj($login,$gold,$db,$poz3,"poz3");
                                }
                                if (filter_input(INPUT_GET, "akcja")=="budujDomPoz4") {
                               
                                buduj($login,$gold,$db,$poz4,"poz4");
                                }
                                
                                ?>
                           
                        </ul>
          </div>
          </div>
            
            <div class="plansza-srodek">
               <div class="mur">
                <?php
                 include_once("plansza-dzialanie.php");
                if($mur==1)
                    echo "<img src='obiekty/zamek.png' alt=''>";
                    ?>
                   </div>
                <div class="poz1">
                    <?php
                     include_once("plansza-dzialanie.php");
                    if($poz1==1)
                    echo "<img src='obiekty/domek.png' alt=''>";
                    ?>
                </div>
                <div class="poz2">
                   <?php
                     include_once("plansza-dzialanie.php");
                    if($poz2==1)
                    echo "<img src='obiekty/domek.png' alt=''>";
                    ?>
                </div>
                <div class="poz3">
                    <?php
                     include_once("plansza-dzialanie.php");
                    if($poz3==1)
                    echo "<img src='obiekty/domek.png' alt=''>";
                    ?>
                </div>
                <div class="poz4">
                    <?php
                     include_once("plansza-dzialanie.php");
                    if($poz4==1)
                    echo "<img src='obiekty/domek.png' alt=''>";
                    ?>
                </div>
        </div>
       
        </div>
   </div>
      
        </div>
         <footer>
        <div >Szymon</div>
    </footer> 
    
        

    
</body>

</html>
