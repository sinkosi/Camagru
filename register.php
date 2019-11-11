<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$message = "Unable to register while logged in";


// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    
    echo "<script>alert('$message');</script>";
    echo '<script>window.location="login.php"</script>';
    //header("location: welcome.php");
    
    exit;
    
}

// Include config file
require_once ('./config/createConnection.php');
 
// Define variables and initialize with empty values
$fullname = $surname = $username = $email = $password = $confirm_password = "";
$fullname_err = $surname_err = $username_err = $email_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    //Validate FirstName
    if(empty(trim($_POST["fullname"]))){
        $fullname_err = "Please enter a First Name.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM user WHERE fullname = :fullname";
        
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":fullname", $param_fullname, PDO::PARAM_STR);
            
            // Set parameters
            $param_fullname = trim($_POST["fullname"]);
            
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
        $sql = "SELECT id FROM user WHERE surname = :surname";
        
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":surname", $param_surname, PDO::PARAM_STR);
            
            // Set parameters
            $param_surname = trim($_POST["surname"]);
            
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
        $sql = "SELECT id FROM user WHERE username = :username";
        
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "This username is already taken.";
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
        $sql = "SELECT id FROM user WHERE email = :email";
        
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
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
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($fullname_err) && empty($surname_err) && empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO user (username, password, email, fullname, surname) VALUES (:username, :password, :email, :fullname, :surname)";
         
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":fullname", $param_fullname, PDO::PARAM_STR);
            $stmt->bindParam(":surname", $param_surname, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = $username;
            $param_email = $email;
            $param_fullname = $fullname;
            $param_surname = $surname;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                mail("sibonelo@mailinator.com", "Camagru: Email Confirmation", "Please confirm your email address");
                header("location: login.php");
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
/*
//EMAIL THINGS
$checker = bin2hex(random_bytes(10));
$token = random_bytes(32);
$link = "http:localhost:8080/camagru/includes/signup.val.php?checker=" .$checker. "&validator=" .bin2hex($token)."&id=".$username;
// $expiry = date("U") + 900;
$message = "copy the link and past it in your browser: ".$link;
mail($mail,"Confirm your Email",$message);
echo '<script>alert("Registered Successfully. Please check your email for a verification link")</script>';
echo '<script>window.location="login.php"</script>';
*/
/*MORE EMAIL SHIT
$to = "sibonelo@live.co.za`";
$subject = "This is subject";

$message = "<b>This is HTML message.</b>";
$message .= "<h1>This is headline.</h1>";

$header = "From:abc@somedomain.com \r\n";
$header .= "Cc:afgh@somedomain.com \r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html\r\n";

$retval = mail ($to,$subject,$message,$header);

if( $retval == true ) {
echo "Message sent successfully...";
}else {
echo "Message could not be sent...";
}*/
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <?php include('header.php') ?>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($fullname_err)) ? 'has-error' : ''; ?>">
                <label>First Name</label>
                <input type="text" name="fullname" class="form-control" value="<?php echo $fullname; ?>">
                <span class="help-block"><?php echo $fullname_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($surname_err)) ? 'has-error' : ''; ?>">
                <label>Surname</label>
                <input type="text" name="surname" class="form-control" value="<?php echo $surname_err; ?>">
                <span class="help-block"><?php echo $surname_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>        
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>