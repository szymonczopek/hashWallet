<?php
include_once("controllers/klasy/Baza.php");
$bd=new Baza("localhost","root","","castle");

 
if(filter_input(INPUT_POST,"submit"))
    {
       $arg = array(
                'login' => ['fil'=> FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'filter'  => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '@^[a-ząęłńśćźżóA-Z0-9\!\@\#\$\%\^\&\*]{1,25}$@'] ],
                'email' => FILTER_VALIDATE_EMAIL,
                'pass'  => ['fil'=> FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'filter'  => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '@^[a-ząęłńśćźżóA-Z0-9\!\@\#\$\%\^\&\*]{1,25}$@'] ],
                'pass2'  => ['fil'=> FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'filter'  => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '@^[a-ząęłńśćźżóA-Z0-9\!\@\#\$\%\^\&\*]{1,25}$@'] ]
                
            );

            $dane = filter_input_array(INPUT_POST, $arg);
           
        
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
                $pass=password_hash($dane['pass2'],PASSWORD_DEFAULT); 
                $bd->insert("INSERT INTO users VALUES (NULL,'$login','$email','$pass',0,0,0,0,0,0)");
            }else{
                echo "<br>Niepoprawne dane: ".$errors."</br>Najedź kursorem na pole w celu podpowiedzi";
            }
    }




?>