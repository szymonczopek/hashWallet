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

     $blockLogin = $blockLogin[0];
     $tempLock=$blockLogin->tempLock;
     if($tempLock > time()){
         $sql="UPDATE block_login SET tempLock='$tempLock'";
         $db->update($sql);
     }
     if($tempLock !== NULL) $user['access']='blocked';

     if($blockLogin->tempLock > time() || NULL) $user['tempLock']=$blockLogin->tempLock-time();

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



            $badLoginNum=$blockLogin->badLoginNum;
            $badLoginNum++;
         if($badLoginNum >= 2){
                $timeAdd= pow($badLoginNum,2)*10;
                $tempLock=time()+$timeAdd;
                $sql="UPDATE block_login SET tempLock='$tempLock'";
                $db->update($sql);
            }
         $sql="UPDATE block_login SET badLoginNum='$badLoginNum', lastBadLoginNum='$date',ipAddress='$ipAddress'";
         $db->update($sql);
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
