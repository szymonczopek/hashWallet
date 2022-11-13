<?php
 session_start();
        include_once("klasy/Baza.php");
            $db = new Baza("localhost", "root", "", "bsiBase");

    $login=$_SESSION['login'];
    $userId=$_SESSION['userId'];
    $salt=$db->selectPole("select salt from users where login='$login'",array("salt"));
    $_SESSION['salt']=$salt;



    if (filter_input(INPUT_POST, "addPassword")) {

        $validate = array(
            'login' => ['filter'  => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '@^[a-ząęłńśćźżóA-Z0-9\.\/\!\@\#\$\%\^\&\*]{1,25}$@'] ],
            'password'  => ['filter'  => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '@^[a-ząęłńśćźżóA-Z0-9\!\/\@\#\$\%\^\&\*]{1,25}$@']],
            'webAddress'  => ['filter'  => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '@^[a-ząęłńśćźżóA-Z0-9\.\!\/\@\#\$\%\^\&\*]{1,100}$@']],
            'description'  => ['filter'  => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '@^[a-ząęłńśćźżóA-Z0-9\.\!\/\@\#\$\%\^\&\*]{1,200}$@']]
        );

        $date = filter_input_array(INPUT_POST, $validate);

       $walletLogin=$date['login'];
       $walletWebAddress=$date['webAddress'];
       $walletDescription=$date['description'];

        $walletPassword=$date['password'];
        $mainPassword=$db->selectPole("select password from users where login='$login'",array("password"));

        $cipher="AES-256-CBC";
        $options=0;
        $iv=str_repeat("0",openssl_cipher_iv_length($cipher));
        $encryptedWalletPassword=openssl_encrypt($walletPassword,$cipher,$mainPassword,$options, $iv);

        $db->insert("INSERT INTO password VALUES (NULL,'$walletLogin','$encryptedWalletPassword','$walletWebAddress','$walletDescription','$userId')");
        header("location: ../controllers/plansza.php");
    }

function showLogin($login,$salt)
{
        echo "User name: ".$login."<br/>";
        echo "Salt: ".$salt;

}
    if(filter_input(INPUT_POST, "editPassword"))
    {
        $validate = array(
            'login' => ['filter'  => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '@^[a-ząęłńśćźżóA-Z0-9\.\/\!\@\#\$\%\^\&\*]{1,25}$@'] ],
            'password'  => ['filter'  => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '@^[a-ząęłńśćźżóA-Z0-9\!\/\@\#\$\%\^\&\*]{1,25}$@']],
            'webAddress'  => ['filter'  => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '@^[a-ząęłńśćźżóA-Z0-9\.\!\/\@\#\$\%\^\&\*]{1,100}$@']],
            'description'  => ['filter'  => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '@^[a-ząęłńśćźżóA-Z0-9\.\!\/\@\#\$\%\^\&\*]{1,200}$@']]
        );

        $date = filter_input_array(INPUT_POST, $validate);
        $idPass=filter_input(INPUT_GET, "edit");
        $errors = "";
        foreach($date as $key => $val){
            if($val === false or $val === NULL){
                $errors .= $key . " ";
            }
        }

        if($errors === ""){
        $walletLogin=$date['login'];
        $walletWebAddress=$date['webAddress'];
        $walletDescription=$date['description'];

        $walletPassword=$date['password'];
        $mainPassword=$db->selectPole("select password from users where login='$login'",array("password"));

        $cipher="AES-256-CBC";
        $options=0;
        $iv=str_repeat("0",openssl_cipher_iv_length($cipher));
        $encryptedWalletPassword=openssl_encrypt($walletPassword,$cipher,$mainPassword,$options, $iv);

        $db->update("UPDATE password SET login = '$walletLogin', password = '$encryptedWalletPassword',web_address='$walletWebAddress',description='$walletDescription' WHERE id_password='$idPass'");

        }else{
        echo "<br>Invalid data: ".$errors."</br>Hover over a field for hints";
    }
        header("location: ../controllers/plansza.php");

    }

if(filter_input(INPUT_GET, "delete"))
{
    $idPass=filter_input(INPUT_GET, "delete");
    $db->delete("DELETE FROM password WHERE id_password='$idPass'");
    header("location: ../controllers/plansza.php");
}

if(filter_input(INPUT_POST,"changePassword"))
{
    $validate = array(
        'currentPass' => ['fil'=> FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'filter'  => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '@^[a-ząęłńśćźżóA-Z0-9\!\@\#\$\%\^\&\*]{1,25}$@'] ],
        'newPass'  => ['fil'=> FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'filter'  => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '@^[a-ząęłńśćźżóA-Z0-9\!\@\#\$\%\^\&\*]{1,25}$@'] ],
        'newPass2'  => ['fil'=> FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'filter'  => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '@^[a-ząęłńśćźżóA-Z0-9\!\@\#\$\%\^\&\*]{1,25}$@']] ,
        'encrypt_choose' => ['fil'=> FILTER_SANITIZE_FULL_SPECIAL_CHARS]
    );

    $data = filter_input_array(INPUT_POST, $validate);

    $user=$db->selectUser($login,$data['currentPass'],"users");


    $errors = "";
    if($user<0)
        $errors.= "Invalid current password";
    if($data['newPass2']!=$data['newPass'])
        $errors.= "Password does not match";

    foreach($data as $key => $val){
        if($val === false or $val === NULL){
            $errors .= $key . " ";
        }
    }

    if($errors === "") {

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $newSalt = '';
        for ($i = 0; $i < 10; $i++) {
            $newSalt .= $characters[rand(0, strlen($characters))];
        }

        $pass = $newSalt . $data['newPass2'];


        if ($data['encrypt_choose'] === "sha") {
            $pass = password_hash($pass, CRYPT_SHA512);
        }
        if ($data['encrypt_choose'] === "hmac") {
            $pass = password_hash($pass, HASH_HMAC);
        }

        //zmiana we wpisach password- poczatek
        $res = $db->showPasswordRow($userId);
        if ($res !== null) {
            foreach ($res as $passwords) {
            $idPass = $passwords->id_password;

            $mainPassword = $db->selectPole("select password from users where login='$login'", array("password"));
            $cipher = "AES-256-CBC";
            $options = 0;
            $iv = str_repeat("0", openssl_cipher_iv_length($cipher));
            $decryptedWalletPassword = openssl_decrypt($passwords->password, $cipher, $mainPassword, $options, $iv);

            $encryptedWalletPassword = openssl_encrypt($decryptedWalletPassword, $cipher, $pass, $options, $iv);

            $db->update("UPDATE password SET password = '$encryptedWalletPassword' WHERE id_password='$idPass'");
        }
    }

       $db->update("UPDATE users SET password = '$pass',salt='$newSalt'WHERE id_user='$userId'");
        header("location: ../controllers/plansza.php");
    }else{

        echo "<br>Invalid data: ".$errors."</br>Hover over a field for hints";
    }

}







        ?>