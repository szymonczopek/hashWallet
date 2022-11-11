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
        echo "<br>Niepoprawne dane: ".$errors."</br>Najedź kursorem na pole w celu podpowiedzi";
    }

      //  header("location: ../controllers/plansza.php");
    }

if(filter_input(INPUT_GET, "delete"))
{
    $idPass=filter_input(INPUT_GET, "delete");
    $db->delete("DELETE FROM password WHERE id_password='$idPass'");
    header("location: ../controllers/plansza.php");
}







        ?>