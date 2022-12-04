<?php
    

class UserManager {
 
 
 function login($db) {
 //funkcja sprawdza poprawność logowania
 //wynik - id użytkownika zalogowanego lub -1
     $data=$this->validateLogin(INPUT_POST);

    $login = $data["login"];
    $passwd = $data["passwd"];
 
    $userId = $db->selectUser($login, $passwd, "users");

        if ($userId >= 0)
        { //Poprawne dane

             session_start();
             $_SESSION['login'] = $login;
             $_SESSION['passwd'] = $passwd;
             $_SESSION['userId'] = $userId;



         //usuń wszystkie wpisy historyczne dla użytkownika o $userId
             $sql="DELETE FROM logged_in_users WHERE userId='$userId'";
             $db->delete($sql);

             $date = $this->getCurrentDate();
             $id_sesji = session_id();

             $sql="INSERT INTO logged_in_users VALUES ('$id_sesji','$userId','$date')";
             $db->insert($sql);
        }
    
    return $userId;
 }
 
    
    function logout($db) {

     session_start();
     $idSession=session_id();

     if ( isset($_COOKIE[session_name()]) )
     {
         setcookie(session_name(),'', time() - 42000, '/');
     }
   session_destroy();
     
     $db->delete("DELETE FROM logged_in_users WHERE sessionId='$idSession' ");
        
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
