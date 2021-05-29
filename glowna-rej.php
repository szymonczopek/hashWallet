<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Castle Zarejestruj</title>
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=MedievalSharp&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="css/style.css">
</head>

  
<body>
    
    <header>
        <div class="baner">
            -Castle-
        </div>
        <div class="navigation">
        
            <div class="right">   
                <div class="main-button"> <a href="index.php">Strona głowna</a></div>
            <div  id="nav-hover" >
                <a href="#">Logowanie</a>
                    
                        <ul>
                            <li><a href="glowna-log.php">Zaloguj</a></li>
                            <li><a href="glowna-rej.php">Zarejetruj</a></li>
                        </ul>
               </div>
        </div>
            </div>
        </header>
   
   <div class=main>
       <div class="register">
       <h3>ZAREJESTRUJ</h3>
           
           <form action="glowna-rej.php" method="post">
           <input name="login" type="text" placeholder="LOGIN" title="Dostępne znaki specjalne !@#$%^&*">
           <input name="email"  placeholder="EMAIL">
           <input name="pass" type="password" placeholder="HASŁO" title="Hasło. Dostępne znaki specjalne !@#$%^&*">
           <input name="pass2" type="password" placeholder="POWTORZ HASŁO" title="Hasła muszą być identyczne">
           <input name="submit" type="submit" value="Zarejestruj">
           </form>
            <?php
       include_once("controllers/register.php");
           
       ?>
       </div>
  
      
        </div>
         <footer>
        <div >Szymon</div>
    </footer> 
    
        

    
</body>

</html>