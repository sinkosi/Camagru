<?php
// Initialize the session
//session_start();
 $current_status = 'Sign Out of Your Account';
 $link_address = 'logout.php';
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    $current_status = 'Sign Into Your Account';
    $link_address = 'login.php';
    //header("location: login.php");
    //exit;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
    <footer>
    
        <a href="<?php echo $link_address;?>" class="btn btn-danger"><?php echo $current_status; ?> </a>
        
        &#169 sinkosi 2019
    </footer>
</html>