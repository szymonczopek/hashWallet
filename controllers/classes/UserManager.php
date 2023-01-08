<?php
    

class UserManager {
 
 
 function login($db) {
 //funkcja sprawdza poprawność logowania
 //wynik - id użytkownika zalogowanego lub -1
     $data=$this->validateLogin(INPUT_POST);

    $login = $data["login"];
    $passwd = $data["passwd"];
 
    $user = $db->selectUser($login, $passwd, "users");
     $userId=$user['id'];
     $ipAddress = $_SERVER['REMOTE_ADDR'];
     $logs= $db->getLog($userId);

     $blockLogin= $db->getBlockLogin($ipAddress);

    //pierwsze logowanie
     if($blockLogin === []) {
         $sql = "INSERT INTO block_login VALUES (null, 0, null, null, null,'$ipAddress')";
         $db->insert($sql);
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
        } else {
            $date = $this->getCurrentDate();
            $sql = "INSERT INTO logged_in_users (userId, lastUpdate, logSuccess, ipAddress) VALUES ('$userId','$date',false,'$ipAddress')";
            $db->insert($sql);

            /*$blockLogin = $blockLogin[0];
            $blockLogin->lastBadLoginNum = $this->getCurrentDate();

            $blockLogin->badLoginNum++;
            if($blockLogin->badLoginNum > 2){
            if($date > $blockLogin->tempLock && $blockLogin->tempLock !== NULL);
            $time= pow($blockLogin->badLoginNum,2)*60;
            }*/
        }
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
