<?php
    session_start();

    $vc = $_SESSION["vc"];
    $email = $_SESSION["email"];
    if(isset($_POST['Email_Confirmation'])){
        mail($email, "Camagru: Email Confirmation", "Camagru Welcomes You\n\nPlease confirm your email address by clicking the attached link: http://localhost:8080/camagru/verify.php?verify=1&vc=".$vc."&email=".$email);
        header("location: logout.php");
    }
?>

<html>
    <head>
        <title>Please Verify Account</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="View/stylesheet.css">      
    </head>
    <body>
        <!--?php include('header.php') ?-->
        <h3>Please check your mail to verify your account</h3>
        <form  method="post">
            <input type="submit" class="btn btn-primary" name="Email_Confirmation" value="Send Email Confirmation" />
        </form>
    </body>
        <!--?php include ('footer.php') ?-->
</html>