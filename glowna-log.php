<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Castle Zaloguj</title>
    
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
       <div class="log">
       <h3>ZALOGUJ</h3>
           <form action="glowna-log.php" method="post">
           <input name="login" type="text" placeholder="LOGIN">
           <input name="passwd" type="password" placeholder="HASŁO">
           <input name="submit" type="submit" value="Zaloguj">
           </form>
           <?php
            include_once("controllers/login.php");
           ?>
       </div>
   
      
        </div>
         <footer>
        <div >Szymon</div>
    </footer> 
    
        

    
</body>

</html>