<?php
    

class UserManager {
 
 
 function login($db) {
 //funkcja sprawdza poprawność logowania
 //wynik - id użytkownika zalogowanego lub -1
 $validate = array(
                'login' => ['fil'=> FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'filter'  => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '@^[a-ząęłńśćźżóA-Z0-9\!\@\#\$\%\^\&\*]{1,25}$@'] ],
                'passwd'  => ['fil'=> FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'filter'  => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '@^[a-ząęłńśćźżóA-Z0-9\!\@\#\$\%\^\&\*]{1,25}$@'] ]
 );

 $dane = filter_input_array(INPUT_POST, $validate);

 $login = $dane["login"];
 $passwd = $dane["passwd"];
 
 
$userId = $db->selectUser($login, $passwd, "users");

     
     if ($userId >= 0) { //Poprawne dane

     session_start();
     $_SESSION['login']=$login;
     $_SESSION['passwd']=$passwd;
     $_SESSION['userId']=$userId;

    
     
 //usuń wszystkie wpisy historyczne dla użytkownika o $userId
     $sql="DELETE FROM logged_in_users WHERE userId='$userId'";
     $db->delete($sql);

     $data=new DateTime('now');
     $data=$data->format("Y-m-d H:i:s");

     $id_sesji=session_id();
     
     $sql="INSERT INTO logged_in_users VALUES ('$id_sesji','$userId','$data')";
     $db->insert($sql); 
 }
    
 return $userId;
      }
 
    
    function logout($db) {

     session_start();
     $id_sesji=session_id();

     if ( isset($_COOKIE[session_name()]) )
     {
         setcookie(session_name(),'', time() - 42000, '/');
     }
   session_destroy();
     
     $db->delete("DELETE FROM logged_in_users WHERE sessionId='$id_sesji' ");
        
    header("location: ../index.php");
 }
 
}
