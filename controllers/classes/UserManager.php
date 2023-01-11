<?php
    

class UserManager {
 
 
 function login($db) {


     $data=$this->validateLogin(INPUT_POST);

    $login = $data["login"];
    $passwd = $data["passwd"];
 
    $user = $db->selectUser($login, $passwd, "users");
     $userId=$user['id'];
     $ipAddress = $_SERVER['REMOTE_ADDR'];
     $logs= $db->getLog($userId);

     $blockLogin= $db->getBlockLogin($ipAddress);
     $blockLogin = $blockLogin[0];

     //pierwsze logowanie
     if($blockLogin === NULL) {
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

            $badLoginNum=$blockLogin->badLoginNum;
            if($badLoginNum >= 2){
                $timeAdd= pow($badLoginNum,2)*10;
                $tempLock=time()+$timeAdd;
                $sql="UPDATE block_login SET tempLock='$tempLock'";
                $db->update($sql);
            }
         $badLoginNum++;
         $sql="UPDATE block_login SET badLoginNum='$badLoginNum', lastBadLoginNum='$date',ipAddress='$ipAddress'";
         $db->update($sql);
        }
     // jesli powyzej 10 wpisow to usuwa najstarszy
     if(count($logs) > 9){
         $sql="DELETE FROM logged_in_users WHERE userId='$userId' AND id = (SELECT MIN(id) FROM logged_in_users)";
         $db->delete($sql);
     }
     //sprawdzenie czy jest blokada na wpisywanie hasla
     $blockLogin= $db->getBlockLogin($ipAddress);
     $blockLogin = $blockLogin[0];
     $tempLock=$blockLogin->tempLock;
     if($tempLock === NULL) $user['blocked']=false; //brak blokady logowania
     else{
         if($tempLock > time()){ //czas jeszcze nie uplynal
             $user['blocked']=true;
             $user['tempLock']=$blockLogin->tempLock-time(); //ile czasu zostalo
         }else { //czas juz spadl, nastepuje odblokowanie
             $sql="UPDATE block_login SET tempLock=NULL";
             $db->update($sql);
             $user['blocked']=false;
             $sql="UPDATE block_login SET badLoginNum=0";
             $db->update($sql);
         }
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
