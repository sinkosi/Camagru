<?php
// Initialize the session
//include('session_update.php');
session_start();
include('session_update.php');
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
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
        .wrapper{margin: auto; width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div>
        <?php include('header.php') ?>
    </div>
    <br>
    <br>
    <br>
    <div class="page-header">
        <h3>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h3>
    </div>
    <div class="wrapper">
        <p>Please fill this form to to change your account.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($fullname_err)) ? 'has-error' : ''; ?>">
                    <label>First Name</label>
                    <input type="text" name="fullname" class="form-control" value="<?php echo $_SESSION["firstname"]; ?>">
                    <span class="help-block"><?php echo $fullname_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($surname_err)) ? 'has-error' : ''; ?>">
                    <label>Surname</label>
                    <input type="text" name="surname" class="form-control" value="<?php echo $_SESSION["surname"]; ?>">
                    <span class="help-block"><?php echo $surname_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $_SESSION["username"]; ?>">
                    <span class="help-block"><?php echo $username_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $_SESSION["email"]; ?>">
                    <span class="help-block"><?php echo $email_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Notifications</label><br>
                    <!--input type="checkbox" name="notification" value="0" checked=0> Receive Comment Notifications<br-->
                    <?php if ($_SESSION["notifications"] == "1") : ?>
                        <select size="1">
                            <option selected="selected">Yes</option>
                            <option>No</option>
                        </select>
                    <?php elseif ($_SESSION["notifications"] == "0") : ?>
                        <select size="1">
                            <option>Yes</option>
                            <option selected="selected">No</option>
                        </select>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
                <input onclick="location.href='/chat.php';" type="submit" class="btn btn-primary" value="Submit">
                </div>
                
            </form>
            <p>
                <button onclick="Del_Account()" class="btn btn-danger">Delete My Account</a>
            </p>
        </div>
    
    <div>
        <?php include('footer.php') ?>
    </div>
    <script>
    function Del_Account() {
        var txt;
        var r = confirm("Are you sure you wish to Delete your Account?");
        if (r == true) {
            txt = "You pressed OK!";
        } else {
            txt = "You pressed Cancel!";
        }
        document.getElementById("demo").innerHTML = txt;
    }
    </script>
</body>
</html>
