<?php
 session_start();
        include_once("klasy/Baza.php");
            $db = new Baza("localhost", "root", "", "castle");

    $login=$_SESSION['login'];
    $gold=$db->select("select gold from users where login='$login'",array("gold"));
    $poz1=$db->select("select poz1 from users where login='$login'",array("poz1"));
    $poz2=$db->select("select poz2 from users where login='$login'",array("poz2"));
    $poz3=$db->select("select poz3 from users where login='$login'",array("poz3"));
    $poz4=$db->select("select poz4 from users where login='$login'",array("poz4"));
    $mur=$db->select("select mur from users where login='$login'",array("mur"));
    
              
            
           
    function wyswietl($login,$gold){  
        echo "Nazwa użytkownika: ".$login."<br/>";
       echo   "Stan konta:".$gold."$</br>";
        }


 function praca($login,$gold,$db,$praca){
     if($praca=="las")
        {
         $gold=$gold+300;
         sleep(3);
     }
     if($praca=="kopalnia")
        {
         $gold=$gold+500;
   sleep(5);
     }
        $db->update("UPDATE users SET gold='$gold' where login='$login'");
     
}
function buduj($login,$gold,$db,$poz,$nazPoz)
{
    if($poz==0)
    {
        if($nazPoz!="mur")
           { 
            if($gold>=200)
            {
                $gold=$gold-200;
                $db->update("UPDATE users SET gold='$gold' where login='$login'");
                $db->update("UPDATE users SET $nazPoz='1' where login='$login'");
            }
            else echo "Posiadasz za mało $!";
        }
        if($nazPoz=="mur")
        {
            if($gold>=500)
            {
                $gold=$gold-500;
                $db->update("UPDATE users SET gold='$gold' where login='$login'");
                $db->update("UPDATE users SET $nazPoz='1' where login='$login'");
            }
            else echo "Posiadasz za mało $!";
        }
    }
    else echo "Posiadasz obiekt na tej pozycji!";
}


?>