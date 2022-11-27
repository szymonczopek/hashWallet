<?php
 include_once 'classes/Baza.php';
 include_once 'classes/UserManager.php';
 $db = new Baza("localhost", "root", "", "bsiBase");
 $um = new UserManager();





 //parametr z GET – akcja = wyloguj
 if (filter_input(INPUT_GET, "akcja")=="wyloguj") {
 $um->logout($db);
 }
 //kliknięto przycisk submit z name = zaloguj
 if (filter_input(INPUT_POST, "submit")=="Login") {
     
 $userId=$um->login($db);

 if ($userId > 0) {
 header("location: controllers/mainBoardView.php");
     
 } else {
 echo "<p>Invalid login or password</p>";
 }
 }  
?>