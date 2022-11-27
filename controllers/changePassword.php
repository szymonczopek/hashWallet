<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> HashWallet Register</title>
    
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
       <div class="register">
       <h3>Change password</h3>
           
           <form action="mainBoardAction.php" method="post">
               <input name="currentPass" type="password" placeholder="Current password" title="Current account password">
               <input name="newPass" type="password" placeholder="New password" title="New account password. Available special characters !@#$%^&*">
               <input name="newPass2" type="password" placeholder="New password repeat" title="Passwords must match">
               Encrypt:<br>
               <div class="radioButtons">
                   <input type="radio" name="encrypt_choose" value="sha"/>
                   <label for="sha">SHA</label>
                   <input type="radio" name="encrypt_choose" value="hmac"/>
                   <label for="hmac">HMAC</label><br>
               </div>
           <input name="changePassword" type="submit" value="Change Password">
           </form>

       </div>
  
      
        </div>
         <footer>
        <div >Szymon Czopek</div>
    </footer> 
    
        

    
</body>

</html>