<?php
include_once "klasy/Baza.php";
$bd=new Baza("localhost","root","","bsiBase");

 
if(filter_input(INPUT_POST,"submit"))
    {
       $validate = array(
                'login' => ['fil'=> FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'filter'  => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '@^[a-ząęłńśćźżóA-Z0-9\!\@\#\$\%\^\&\*]{1,25}$@'] ],
                'email' => FILTER_VALIDATE_EMAIL,
                'pass'  => ['fil'=> FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'filter'  => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '@^[a-ząęłńśćźżóA-Z0-9\!\@\#\$\%\^\&\*]{1,25}$@'] ],
                'pass2'  => ['fil'=> FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'filter'  => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '@^[a-ząęłńśćźżóA-Z0-9\!\@\#\$\%\^\&\*]{1,25}$@']] ,
                'encrypt_choose' => ['fil'=> FILTER_SANITIZE_FULL_SPECIAL_CHARS]
            );

            $dane = filter_input_array(INPUT_POST, $validate);
           

            $errors = "";
           if($dane['pass2']!=$dane['pass'])
               $errors.= "Hasla nie sa zgodne!";
            
                foreach($dane as $key => $val){
                if($val === false or $val === NULL){
                    $errors .= $key . " ";
                }
            }

            if($errors === ""){
              
                $login=$dane['login'];
                $email=$dane['email'];

                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $salt = '';
                for ($i = 0; $i < 10; $i++) {
                    $salt .= $characters[rand(0, strlen($characters))];
                }

                $pass=$salt.$dane['pass2'];

                if($dane['encrypt_choose']==="sha")
                {
                    $pass=password_hash($pass,CRYPT_SHA512);
                }
                if($dane['encrypt_choose']==="hmac")
                {
                    $pass=password_hash($pass,HASH_HMAC);
                }

                $bd->insert("INSERT INTO users VALUES (NULL,'$login','$email','$pass','$salt')");
            }else{
                echo "<br>Niepoprawne dane: ".$errors."</br>Najedź kursorem na pole w celu podpowiedzi";
            }
    }




?>