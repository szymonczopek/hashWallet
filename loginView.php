<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> HashWallet Login</title>
    
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
                            <li><a href="loginView.php">Login</a></li>
                            <li><a href="registerView.php">Register</a></li>
                        </ul>
               </div>
        </div>
            </div>
        </header>
   
   <div class=main>
       <div class="log">
       <h3>Login</h3>
           <form action="loginView.php" method="post">
           <input name="login" type="text" placeholder="Login">
           <input name="passwd" type="password" placeholder="Password">
           <input name="submit" type="submit" value="Login">
           </form>
           <?php
            include_once("controllers/login.php");
           ?>
       </div>
   
      
        </div>
         <footer>
        <div >Szymon Czopek</div>
    </footer> 
    
        

    
</body>

</html>