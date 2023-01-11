<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hash Wallet </title>
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=MedievalSharp&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/mainBoard.css">
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
                            <li><a href="mainBoardView.php">Home</a></li>
                            <li><a href="changePassword.php">Change password</a></li>
                        </ul>
               </div>
                <div class="main-button"> <a href='login.php?akcja=wyloguj' >Logout</a></div>
                
        </div>
            </div>
        </header>
   
   <div class=main>
    <div class="plansza-tlo">

          <?php
          include ("mainBoardAction.php");
          $db = new Baza("localhost", "root", "", "bsiBase");
          $passOb= new Password();
          $login=$_SESSION['login'];
          $userId=$_SESSION['userId'];

          echo '<div class="login">';
          echo   $passOb->showLogin($login); //pokazywanie loginu
          echo '</div>';

          echo '<div class="board">';
          echo '<div class="logged">';

          $logs=$db->getLog($userId);
          if($logs!=null) {
              echo '<div class="tableTitle">Last login</div>';
              echo '<table>';
              echo '<thead>';
              echo '<tr>';
              echo '<th>Success</th>';
              echo '<th>Session ID</th>';
              echo '<th>User ID</th>';
              echo '<th>Date</th>';
              echo '<th>IP Address</th>';
              echo '<th> </th>';
              echo '</tr>';
              echo '</thead>';

          }


          foreach ($logs as $log){
              echo '<tr>';
              echo '<th>';
              if($log->logSuccess ==1 ) echo '✔';
              else echo '❌';
              echo '<th>'.$log->sessionId.'</th>';
              echo '<th>'.$log->userId.'</th>';
              echo '<th>'.$log->lastUpdate.'</th>';

              echo'</th>';
              echo '<th>'.$log->ipAddress.'</th>';
              echo '<tr>';

          }
          echo'</table>';
          echo '</div>';

          echo '<div class="wallet">';

          $res=$db->getPasswordRow($userId);
    if($res!=null) {
        echo '<div class="tableTitle">Passwords wallet</div>';
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
             echo '<th>'."<a href='mainBoardEditPassword.php?edit=$passwords->id_password'>Edit row</a>".'</th>';
             echo '<th>'."<a href='mainBoardShowPasswords.php?show=$passwords->id_password'>Show password</a>".'</th>';
             echo '<th>'."<a href='mainBoardAction.php?delete=$passwords->id_password'>X</a>".'</th>';
             echo '<tr>';

         }
          echo'</table>';


          echo '</div>';
          echo '</div>';
            ?>

        <a href='mainBoardNewPassword.php'>Add new password</a>

    </div>
   </div>


         <footer>
        <div >Szymon</div>
    </footer> 
    
        

    
</body>

</html>
