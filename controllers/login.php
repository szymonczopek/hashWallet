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
     
 $user=$um->login($db);

 if ($user['access'] === true) {
     header("location: controllers/mainBoardView.php");
     
 }
 if ($user['access']=== 'blocked'){
     if($user['tempLock'] !== NULL) {
         $tempLock = $user['tempLock'];
         $tempLockMin = (int)($tempLock / 60);
         $tempLockSec = (int)($tempLock - ($tempLockMin * 60));
         /*if ($tempLock !== NULL)*/ echo "Blocked for" . $tempLockMin . "min " . $tempLockSec . "sec.";
     }
 }
 else {
 echo "<p>Invalid login or password</p>";
 }
 }  
?>