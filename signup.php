<!DOCTYPE html>
<html>
    <header>
    <!--    <link rel="stylesheet" type="text/css" href="index.css">-->
        <title>SIGN UP</title>
    </header>
    <body>

        <div id="login">
            <div class="title">SIGNUP</div>
            <div id="container">
           <form method="POST" style="position: Relative;" action="signup.val.php">
          <label>Fullname: </label>
          <input id="fullname" name="fullname" placeholder="Fullname" type="text">
          <label>Surname: </label>
          <input id="surname" name="surname" placeholder="Surname" type="text">
          <label>Username: </label>
          <input id="name" name="username" placeholder="username" type="text">
          <label>Email: </label>
          <input id="name" name="username" placeholder="E-mail" type="mail">
          <label>Password: </label>
          <input id="password" name="password" placeholder="password" type="password">
          <label>Confirm Password: </label>
          <input id="password" name="confirm-password" placeholder="confirm-password" type="password">
          <input name="submit" type="submit" value=" Register ">
          /*<!-- span>
            <--?php
            echo $_SESSION['error'];
            $_SESSION['error'] = null;
            if (isset($_SESSION['signup_success'])) {
              echo "Signup success please check your mail box";
              $_SESSION['signup_success'] = null;
            }
            ?
          </span -->*/
        </form>
      </div>
    </div>
  </body>
</html>