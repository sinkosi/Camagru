<!DOCTYPE html>
<html>
<head>
    
</head>
<body>
    <?php include ('header.php') ?>

<div class="wrapper">
    <h2>Reset Password</h2>
    <p>Please fill out this form to reset your password.</p>
    <div class="form">
        <h3>Enter your email</h3>
        <form action="./reset_mail.php" method="POST">
            <input type="email" name="email" placeholder="E-mail"/>
            <button type="submit" name="submit">Submit</button>
            <button formaction="login.php">Login</button>
        </form>
    </div>
    <br>
    <br>
</div>
    <?php include ('footer.php') ?>
</html>