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
    if($user !== NULL) $userId=$user['id'];
     $ipAddress = $_SERVER['REMOTE_ADDR'];

 if($user === NULL) echo "<p>User not found</p>"; //brak usera
else{
    if ($user['access'] === true){ //poprawne dane
        if ($user['blocked'] === true){ //zablokowany
            if($user['tempLock'] !== NULL) { //wyswietlanie czasu
                $tempLock = $user['tempLock'];
                $tempLockMin = (int)($tempLock / 60);
                $tempLockSec = (int)($tempLock - ($tempLockMin * 60));
                if($tempLockMin === 0) echo "Blocked for " . $tempLockSec . "sec";
                else echo "Blocked for " . $tempLockMin . "min " . $tempLockSec . "sec";
            }else echo "<p>Błąd związany z czasem</p>";
        }
        else {
            //prawidlowe logowanie
            $sql="UPDATE block_login SET badLoginNum=0 WHERE userId='$userId' AND ipAddress='$ipAddress'";
            $db->update($sql);
            header("location: controllers/mainBoardView.php");
        }
        }
        else { //niepoprawne dane
            if ($user['blocked'] === true){
                $blockLogin= $db->getBlockLogin($ipAddress,$userId); //ile czasu zostalo jeszcze raz zeby bylo aktualne
                $blockLogin = $blockLogin[0];
                $tempLock=$blockLogin->tempLock;
                $tempLock=$tempLock-time();
                if($tempLock !== NULL) {
                    $tempLockMin = (int)($tempLock / 60);
                    $tempLockSec = (int)($tempLock - ($tempLockMin * 60));
                    if($tempLockMin === 0) echo "Blocked for " . $tempLockSec . "sec";
                    else echo "Blocked for " . $tempLockMin . "min " . $tempLockSec . "sec";
                }else echo "<p>Błąd związany z czasem</p>";
            }
        else echo "<p>Invalid password</p>";
         }
    }
 }
?>