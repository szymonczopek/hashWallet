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
}

//edit password------------------------------------
if (filter_input(INPUT_POST, "editPassword"))
{
    $passOb->editPassword($db,$login);
}
//delete password ----------------------------------
if (filter_input(INPUT_GET, "delete"))
{
    $passOb->deletePassword($db);
}

// change main password-------------------------------
if (filter_input(INPUT_POST, "changePassword"))
{
    $passOb->changeMainPassword($db,$login,$userId);
}

?>