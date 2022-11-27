<?php
declare(strict_types=1);

 session_start();
        include_once("classes/Baza.php");
        include_once("classes/Password.php");
            $db = new Baza("localhost", "root", "", "bsiBase");
            $passOb= new Password();


            $login = $_SESSION['login'];
            $userId = $_SESSION['userId'];

//add password----------------------------
if (filter_input(INPUT_POST, "addPassword"))
{
    $passOb->addPassword($db,$login,$userId);

/*$data = validateRecordPassword(INPUT_POST);

$errors = isValidationCorrect($data);

if ($errors === "")
{
$walletRecordLogin = $data['login'];
$walletRecordWebAddress = $data['webAddress'];
$walletRecordDescription = $data['description'];
$walletRecordPassword = $data['password'];
$mainRecordPassword = $db->selectPole("select password from users where login='$login'", array("password"));

$encryptedWalletRecordPassword = hashWalletPassword($walletRecordPassword, $mainRecordPassword);

$db->insert("INSERT INTO password VALUES (NULL,'$walletRecordLogin','$encryptedWalletRecordPassword','$walletRecordWebAddress','$walletRecordDescription','$userId')");
header("location: ../controllers/mainBoardView.php");
}

else
{
    echo "<br>Invalid data: " . $errors . "</br>Hover over a field for hints";
}*/

}

//edit password------------------------------------
if (filter_input(INPUT_POST, "editPassword")) {
    $passOb->editPassword($db,$login);
    /*$data = validateRecordPassword(INPUT_POST);

    $idPass = filter_input(INPUT_GET, "edit");

    $errors = isValidationCorrect($data);

    if ($errors === "") {
        $walletRecordLogin = $data['login'];
        $walletRecordWebAddress = $data['webAddress'];
        $walletRecordDescription = $data['description'];
        $walletRecordPassword = $data['password'];
        $mainRecordPassword = $db->selectPole("select password from users where login='$login'", array("password"));

        $encryptedWalletRecordPassword = hashWalletPassword($walletRecordPassword, $mainRecordPassword);
        $db->update("UPDATE password SET login = '$walletRecordLogin', password = '$encryptedWalletRecordPassword',web_address='$walletRecordWebAddress',description='$walletRecordDescription' WHERE id_password='$idPass'");
        header("location: ../controllers/mainBoardView.php");
    } else {
        echo "<br>Invalid data: " . $errors . "</br>Hover over a field for hints";
    }*/
}
//delete password ----------------------------------
if (filter_input(INPUT_GET, "delete")) {
    $passOb->deletePassword($db);
   /* $idPass = filter_input(INPUT_GET, "delete");
    $db->delete("DELETE FROM password WHERE id_password='$idPass'");
    header("location: ../controllers/mainBoardView.php");*/
}

// change main password-------------------------------
if (filter_input(INPUT_POST, "changePassword")) {
    $passOb->changeMainPassword($db,$login,$userId);
    /*$data = validateChangePassword(INPUT_POST);
    $user = $db->selectUser($login, $data['currentPass'], "users");

    $errors = isChangePasswordDataCorrect($user, $data);

    if ($errors === "") {
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
        $res = $db->getPasswordRow($userId);
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
        } //-zmiana we wspisach -koniec

        $db->update("UPDATE users SET password = '$pass',salt='$newSalt'WHERE id_user='$userId'");
        header("location: ../controllers/mainBoardView.php");
    } else {

        echo "<br>Invalid data: " . $errors . "</br>Hover over a field for hints";
    }*/

}
/*function showLogin($login)
{
    echo "User name: " . $login . "<br/>";
}

function validateRecordPassword($input)
{
    $validate = array(
        'login' => ['filter' => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '@^[a-ząęłńśćźżóA-Z0-9\.\/\!\@\#\$\%\^\&\*]{1,25}$@']],
        'password' => ['filter' => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '@^[a-ząęłńśćźżóA-Z0-9\!\/\@\#\$\%\^\&\*]{1,25}$@']],
        'webAddress' => ['filter' => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '@^[a-ząęłńśćźżóA-Z0-9\.\!\/\@\#\$\%\^\&\*]{1,100}$@']],
        'description' => ['filter' => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '@^[a-ząęłńśćźżóA-Z0-9\.\!\/\@\#\$\%\^\&\*]{1,200}$@']]
    );

    $data = filter_input_array($input, $validate);
    return $data;
}

function isValidationCorrect($data)
{
    $errors = "";
    foreach ($data as $key => $val) {
        if ($val === false or $val === NULL) {
            $errors .= $key . " ";
        }
    }
    return $errors;
}

function hashWalletPassword($walletPassword, $mainAccountPassword)
{
    $cipher = "AES-256-CBC";
    $options = 0;
    $iv = str_repeat("0", openssl_cipher_iv_length($cipher));
    $encryptedWalletPassword = openssl_encrypt($walletPassword, $cipher, $mainAccountPassword, $options, $iv);
    return $encryptedWalletPassword;
}

function isChangePasswordDataCorrect($user, $data)
{
    $errors = "";
    if ($user < 0)
        $errors .= "Invalid current password";
    if ($data['newPass2'] != $data['newPass'])
        $errors .= "Password does not match";

    foreach ($data as $key => $val) {
        if ($val === false or $val === NULL) {
            $errors .= $key . " ";
        }
    }
    return $errors;
}

function validateChangePassword($input)
{
    $validate = array(
        'currentPass' => ['fil' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'filter' => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '@^[a-ząęłńśćźżóA-Z0-9\!\@\#\$\%\^\&\*]{1,25}$@']],
        'newPass' => ['fil' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'filter' => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '@^[a-ząęłńśćźżóA-Z0-9\!\@\#\$\%\^\&\*]{1,25}$@']],
        'newPass2' => ['fil' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'filter' => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '@^[a-ząęłńśćźżóA-Z0-9\!\@\#\$\%\^\&\*]{1,25}$@']],
        'encrypt_choose' => ['fil' => FILTER_SANITIZE_FULL_SPECIAL_CHARS]
    );

    $data = filter_input_array($input, $validate);
    return $data;

}*/
?>