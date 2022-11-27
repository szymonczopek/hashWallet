<?php
include_once "classes/Baza.php";
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

            $data = filter_input_array(INPUT_POST, $validate);
           

            $errors = "";
           if($data['pass2']!=$data['pass'])
               $errors.= "Password does not match";
            
                foreach($data as $key => $val){
                if($val === false or $val === NULL){
                    $errors .= $key . " ";
                }
            }

            if($errors === ""){
              
                $login=$data['login'];
                $email=$data['email'];

                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $salt = '';
                for ($i = 0; $i < 10; $i++) {
                    $salt .= $characters[rand(0, strlen($characters))];
                }

                $pass=$salt.$data['pass2'];

                if($data['encrypt_choose']==="sha")
                {
                    $pass=password_hash($pass,CRYPT_SHA512);
                }
                if($data['encrypt_choose']==="hmac")
                {
                    $pass=password_hash($pass,HASH_HMAC);
                }

                $bd->insert("INSERT INTO users VALUES (NULL,'$login','$email','$pass','$salt')");
            }else{
                echo "<br>Invalid data: ".$errors."</br>Hover over a field for hints";
            }
    }




?>