<?php
    

class UserManager {
 
 
 function login($db) {


     $data=$this->validateLogin(INPUT_POST);

    $login = $data["login"];
    $passwd = $data["passwd"];
 
    $user = $db->selectUser($login, $passwd, "users");
    if($user === NULL) return $user; // nie ma takiego usera
     $userId=$user['id'];
     $ipAddress = $_SERVER['REMOTE_ADDR'];
     $blockLogin= $db->getBlockLogin($ipAddress,$userId);
     $blockLogin = $blockLogin[0];

     //sprawdzenie czy jest blokada na wpisywanie hasla
     $tempLock=$blockLogin->tempLock;
     if($tempLock === NULL) { //brak blokady logowania
         $user['blocked']=false;
     }
     else{ //jest blokada
         if($tempLock > time()){ //czas jeszcze nie uplynal
             $user['blocked']=true;
             $user['tempLock']=$blockLogin->tempLock-time(); //ile czasu zostalo
         }else { //czas juz spadl, nastepuje odblokowanie
             $sql="UPDATE block_login SET tempLock=NULL WHERE userId='$userId'";
             $db->update($sql);
             $user['blocked']=false;
             $sql="UPDATE block_login SET badLoginNum=0 WHERE userId='$userId'";
             $db->update($sql);
         }
     }


     if ($user['access'] === true)
        { //Poprawne dane

             session_start();
             $_SESSION['login'] = $login;
             $_SESSION['passwd'] = $passwd;
             $_SESSION['userId'] = $user['id'];

             $date = $this->getCurrentDate();
             $idSession = session_id();

             $sql="INSERT INTO logged_in_users VALUES ('$idSession','$userId','$date',true,null,'$ipAddress')";
             $db->insert($sql);

        } else { //zle wpisane haslo, zarejestrowanie tego
            $date = $this->getCurrentDate();
            $sql = "INSERT INTO logged_in_users (userId, lastUpdate, logSuccess, ipAddress) VALUES ('$userId','$date',false,'$ipAddress')";
            $db->insert($sql);

         $blockLogin= $db->getBlockLogin($ipAddress,$userId);
         $blockLogin = $blockLogin[0];
         $badLoginNum=$blockLogin->badLoginNum;
            if($badLoginNum >= 2){
                $timeAdd= pow($badLoginNum,2)*10;
                $tempLock=time()+$timeAdd;
                $sql="UPDATE block_login SET tempLock='$tempLock' WHERE userId='$userId'";
                $db->update($sql);
            }
         $badLoginNum++;
         $sql="UPDATE block_login SET badLoginNum='$badLoginNum', lastBadLoginNum='$date',ipAddress='$ipAddress' WHERE userId='$userId'";
         $db->update($sql);
        }
     // jesli powyzej 10 wpisow to usuwa najstarszy
     $logs= $db->getLog($userId);
     if(count($logs) > 9){
         $sql="DELETE FROM logged_in_users WHERE userId='$userId' AND id = (SELECT MIN(id) FROM logged_in_users)";
         $db->delete($sql);
     }

     return $user;
 }
 
    
    function logout($db) {

     session_start();
     $idSession=session_id();

     if ( isset($_COOKIE[session_name()]) )
     {
         setcookie(session_name(),'', time() - 42000, '/');
     }
   session_destroy();

    header("location: ../index.php");
 }
    function validateLogin($input)
    {
        $validate = array(
            'login' => ['fil' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'filter' => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '@^[a-ząęłńśćźżóA-Z0-9\!\@\#\$\%\^\&\*]{1,25}$@']],
            'passwd' => ['fil' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'filter' => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '@^[a-ząęłńśćźżóA-Z0-9\!\@\#\$\%\^\&\*]{1,25}$@']]
        );

        $data = filter_input_array($input, $validate);
        return $data;
    }
    function getCurrentDate(){
        $date=new DateTime('now');
        $date=$date->format("Y-m-d H:i:s");
        return $date;
    }
 
}
