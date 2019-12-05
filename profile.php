<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
// Initialize the session
include('session_update.php');

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

//VALIDATE YOUR UPDATES HERE
// Include config file
include ('./config/createConnection.php');
 
// Define variables and initialize with empty values
$fullname = $surname = $username = $email = $notifications = "";
$fullname_err = $surname_err = $username_err = $email_err = "";
$userid = $_SESSION["id"];

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Validate FirstName
    if(empty(trim($_POST["fullname"]))){
        $fullname_err = "Please enter a First Name.";
    } else{
        // Prepare a select statement
        $sql = "SELECT userid FROM user WHERE fullname = :fullname";
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":fullname", $param_fullname, PDO::PARAM_STR);
            //$stmt->bindParam(":userid", $param_id, PDO::PARAM_INT);
            // Set parameters
            $param_fullname = trim($_POST["fullname"]);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                $fullname = trim($_POST["fullname"]);
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        // Close statement
        unset($stmt);
    }

    //Validate Surname
    if(empty(trim($_POST["surname"]))){
        $surname_err = "Please enter a Surname.";
    } else{
        // Prepare a select statement
        //$sql = "UPDATE user SET surname = :surname WHERE userid = :userid";
        $sql = "SELECT userid FROM user WHERE surname = :surname";
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":surname", $param_surname, PDO::PARAM_STR);
            //$stmt->bindParam(":userid", $param_id, PDO::PARAM_INT);
            // Set parameters
            $param_surname = trim($_POST["surname"]);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                $surname = trim($_POST["surname"]);
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }            
        // Close statement
        unset($stmt);
    }

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        //$sql = "UPDATE user SET username = :username WHERE userid = :userid";
        $sql = "SELECT userid FROM user WHERE username = :username";
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            //$stmt->bindParam(":userid", $param_id, PDO::PARAM_INT);
            // Set parameters
            $param_username = trim($_POST["username"]);
            //$param_id = $_SESSION["id"];
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1 && $param_username !== $_SESSION["username"]){
                    $username_err = "This username is already taken.";
                    //$username_err = print_r($_POST);
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        // Close statement
        unset($stmt);
    }

    // Validate email
    if(empty(trim($_POST['email']))){
        $email_err = "Please enter a valid email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT userid FROM user WHERE email = :email";
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            // Set parameters
            $param_email = trim($_POST["email"]);
            $param_id = $_SESSION["id"];
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1 && $param_email !== $_SESSION["email"]){
                    $email_err = "This E-mail address is already registered.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }    
        // Close statement
        unset($stmt);
    }

    if($_POST['notifications'] !== "0" && $_POST['notifications'] !== "1"){
        $fullname_err = "Notification error";
    } else{
        // Prepare a select statement
        $sql = "SELECT userid FROM user WHERE notifications = :notifications";
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":notifications", $param_notifications, PDO::PARAM_INT);

            // Set parameters
            $param_notifications = $_POST["notifications"];
            $param_id = $_SESSION["id"];

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1 && $_SESSION["verified"] == "0"){
                    $fullname_err = "Unable to remove notifications, Please verify Account";
                } else{
                    $notifications = ($_POST["notifications"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }    
        // Close statement
        unset($stmt);
    }

    // Check input errors before inserting in database
    if(empty($fullname_err) && empty($surname_err) && empty($username_err) && empty($email_err)){
        
        // Prepare an insert statement
        $sql = "UPDATE user SET username = :username, email = :email, fullname = :fullname, surname = :surname, notifications = :notifications  WHERE userid=:userid";
                 
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            //$stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":fullname", $param_fullname, PDO::PARAM_STR);
            $stmt->bindParam(":surname", $param_surname, PDO::PARAM_STR);
            $stmt->bindParam(":notifications", $param_notifications, PDO::PARAM_INT);
            $stmt->bindParam(":userid", $param_id, PDO::PARAM_INT);
            
            // Set parameters
            $param_username = $username;
            $param_email = $email;
            $param_fullname = $fullname;
            $param_surname = $surname;
            $param_notifications = $notifications;
            $param_id = $_SESSION["id"];

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                mail($email, "Camagru: Updated Details", "Your details have been successfully updated on website 'Camagru'");
                header("location: profile.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($conn);
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
                    <label>Account Status</label><br>
                    <?php if ($_SESSION["verified"] == "0") : ?>
                        <select size="1">
                            <option selected="selected">NOT VERIFIED</option>
                        </select>
                    <?php elseif ($_SESSION["verified"] == "1") : ?>
                        <select size="1">
                            <option selected="selected">VERIFIED</option>
                        </select>
                    <?php endif; ?>
                    
                    <br>
                    <label>Notifications</label><br>
                    <!--input type="checkbox" name="notification" value="0" checked=0> Receive Comment Notifications<br-->

                    <?php if ($_SESSION["notifications"] == "1") : ?>
                        <select name="notifications"size="1">
                            <option value="1" selected="selected">Yes</option>
                            <option value="0">No</option>
                        </select>
                    <?php elseif ($_SESSION["notifications"] == "0") : ?>
                        <select name="notifications" size="1">
                            <option value="1">Yes</option>
                            <option value="0" selected="selected">No</option>
                        </select>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
                <input type="submit" class="btn btn-primary" value="Submit">
                </div>
                
            </form>
            <p>
                <button onclick="Del_Account()" class="btn btn-danger">Delete My Account</a>
            </p>
        </div>
    <?php if ($_SESSION["verified"] == "0") :?>
    <div>
        <?php include('checkmail.php') ?>
        <br>
    </div>
    <?php endif; ?>
    <div>
        <?php include('footer.php') ?>
    </div>
    <script>
    function Del_Account() {
        var txt;
        var r = confirm("Are you sure you wish to Delete your Account?");
        if (r == true) {
            window.location="delete_account.php";
        } else {
            txt = "You pressed Cancel!";
        }  
    }
    </script>
</body>
</html>
