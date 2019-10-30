<?php

?>

<!DOCTYPE html>
 <html>
    <head>
        <title>Camagru - Login</title>
        <link rel="stylesheet" type="text/css" href="View/stylesheet.css">
     </head>
     <body>
         <?php include('header.php') ?>
         
        <div id="login">

        <div id="container">
            <form action="./login.php" method="POST">
                <br>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Username/E-mail...." required="email"/>
                <br>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password...." required/>
                <br>
                <input type="submit" name="submit" />

             </form>
             <div class="register">
             <p>Don't have an account?</p><a href="signup.php">Signup</a>
             <form action="#" method="POST">
                <button type="submit" name="Logout-submit">Logout</button>
             </form>
            </div>
         </div>
     </body>
 </html>