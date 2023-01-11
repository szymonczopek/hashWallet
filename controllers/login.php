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
 if($user === NULL) echo "<p>User not found</p>"; //brak usera
else{
    if ($user['access'] === true && $user['blocked'] === true){ //zablokowane zablokowane logowanie, nawet przy dobrym hasle
        if($user['tempLock'] !== NULL) {
            $tempLock = $user['tempLock'];
            $tempLockMin = (int)($tempLock / 60);
            $tempLockSec = (int)($tempLock - ($tempLockMin * 60));
            if($tempLockMin === 0) echo "Blocked for " . $tempLockSec . "sec";
            else echo "Blocked for " . $tempLockMin . "min " . $tempLockSec . "sec";
        }else echo "<p>Błąd związany z czasem</p>";
    }
    if ($user['access'] === true && $user['blocked'] === false ) { //prawidlowe logowanie
        header("location: controllers/mainBoardView.php");
    }
 else {
 echo "<p>Invalid password</p>";
 }
}
 }  
?>