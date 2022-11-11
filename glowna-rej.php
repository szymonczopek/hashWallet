<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> HashWallet Register</title>
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=MedievalSharp&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="css/style.css">
</head>

  
<body>
    
    <header>
        <div class="baner">
            HashWallet
        </div>
        <div class="navigation">
        
            <div class="right">   
                <div class="main-button"> <a href="index.php">Home</a></div>
            <div  id="nav-hover" >
                <a href="#">Login</a>
                    
                        <ul>
                            <li><a href="glowna-log.php">Login</a></li>
                            <li><a href="glowna-rej.php">Register</a></li>
                        </ul>
               </div>
        </div>
            </div>
        </header>
   
   <div class=main>
       <div class="register">
       <h3>Register</h3>
           
           <form action="glowna-rej.php" method="post">
           <input name="login" type="text" placeholder="Login" title="Dostępne znaki specjalne !@#$%^&*">
           <input name="email"  placeholder="Email">
           <input name="pass" type="password" placeholder="Password" title="Hasło. Dostępne znaki specjalne !@#$%^&*">
           <input name="pass2" type="password" placeholder="Password" title="Hasła muszą być identyczne">
               Encrypt:<br>
               <div class="radioButtons">
                   <input type="radio" name="encrypt_choose" value="sha"/>
                   <label for="sha">SHA</label>
                   <input type="radio" name="encrypt_choose" value="hmac"/>
                   <label for="hmac">HMAC</label><br>
               </div>
           <input name="submit" type="submit" value="Register">
           </form>
            <?php
       include_once("controllers/register.php");

       ?>
       </div>
  
      
        </div>
         <footer>
        <div >Szymon Czopek</div>
    </footer> 
    
        

    
</body>

</html>