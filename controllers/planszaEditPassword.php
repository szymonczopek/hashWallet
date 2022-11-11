<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Castle Plansza </title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=MedievalSharp&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/gra.css">
</head>


<body>


<header>
    <div class="baner">
        HashWallet
    </div>
    <div class="navigation">

        <div class="right">

            <div  id="nav-hover" >
                <a href="#">My account</a>

                <ul>
                    <li><a href="plansza.php">Home</a></li>
                    <li><a href="#">Change password</a></li>
                </ul>
            </div>
            <div class="main-button"> <a href='login.php?akcja=wyloguj' >Logout</a></div>

        </div>
    </div>
</header>

<div class=main>
    <div class="plansza-tlo">

        <?php
        include ("plansza-dzialanie.php");
        $db = new Baza("localhost", "root", "", "bsiBase");
        $login=$_SESSION['login'];
        $salt=$_SESSION['salt'];
        $userId=$_SESSION['userId'];

        echo '<div class="login">';
        showLogin($login,$salt); //pokazywanie loginu i soli
        echo '</div>';

        echo '<div class="wallet">';
        $res=$db->showPasswordRow($userId);

        if($res!=null) {
            echo '<table>';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Login</th>';
            echo '<th>Password</th>';
            echo '<th>Description</th>';
            echo '<th>Web Address</th>';
            echo '<th> </th>';
            echo '</tr>';
            echo '</thead>';
        }

        foreach ($res as $passwords){
            echo '<tr>';
            echo '<th>'.$passwords->login.'</th>';
            echo '<th>'.$passwords->password.'</th>';
            echo '<th>'.$passwords->description.'</th>';
            echo '<th>'.$passwords->web_address.'</th>';
            echo '<th>'."<a href='planszaEditPassword.php?edit=$passwords->id_password'>Edit row</a>".'</th>';
            echo '<th>'."<a href='plansza-show.php?show=$passwords->id_password'>Show password</a>".'</th>';
            echo '<th>'."<a href='plansza-dzialanie.php?delete=$passwords->id_password'>Delete row</a>".'</th>';
            echo '<tr>';

        }
        echo'</table>';
        echo '</div>';

        $idPass=filter_input(INPUT_GET,'edit');


      echo'  <div class="plansza-form">';
        echo'    <form action="plansza-dzialanie.php?edit='.$idPass.'" method="post">';
         echo'       <div style="color: gold;font-size: 25px;">Edit password<br></div>';
         echo'       <input name="login" placeholder="Login"><br>';
          echo'      <input name="password" placeholder="Password"><br>';
          echo'      <input name="description" placeholder="Description"><br>';
          echo'      <input name="webAddress" placeholder="Web Address"><br>';
          echo'      <input type="submit" value="Edit" name="editPassword">';
         echo'   </form>';
      echo'  </div>';
        ?>
    </div>

</div>


<footer>
    <div >Szymon</div>
</footer>




</body>

</html>
