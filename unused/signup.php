<?php

?>

<!DOCTYPE html>
<html>
    <head>
      <title>Camagru - SIGN UP</title>
      <link rel="stylesheet" type="text/css" href="View/stylesheet.css">
      
    </head>
    <body>
        <?php include('header.php') ?>
        <div id="login">

        <form method="POST" style="position: Relative;" action="Model/insertData.php">
          <br>
          <br>
          <label>Fullname: </label>
          <input id="fullname" name="fullname" placeholder="Fullname" type="text">
          <br>
          <label>Surname: </label>
          <input id="surname" name="surname" placeholder="Surname" type="text">
          <br>
          <label>Username: </label>
          <input id="name" name="username" placeholder="username" type="text">
          <br>
          <label>Email: </label>
          <input id="name" name="email" placeholder="E-mail" type="mail">
          <br>
          <label>Password: </label>
          <input id="password" name="password" placeholder="password" type="password">
          <br>
          <label>Confirm Password: </label>
          <input id="password" name="confirm-password" placeholder="confirm-password" type="password">
          <br>
          <input name="submit" type="submit" value=" Register ">
        </form>
      </div>
    </div>
  </body>
</html>