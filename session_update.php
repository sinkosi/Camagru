<?php
// Initialize the session
//session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
/*if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: profile.php");
    exit;
}*/
 
// Include config file
require_once "./config/createConnection.php";
$username = $_SESSION["username"];

$sql = "SELECT id, username, email, fullname, surname, verified, notifications, password FROM user WHERE username = :username";
        
if($stmt = $conn->prepare($sql)){
    // Bind variables to the prepared statement as parameters
    $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
    
    // Set parameters
    $param_username = trim($_SESSION["username"]);
    
    // Attempt to execute the prepared statement
    if($stmt->execute()){
        // Check if username exists, if yes then verify password
        if($stmt->rowCount() == 1){
            if($row = $stmt->fetch()){
                $id = $row["id"];
                $username = $row["username"];
                $user_email = $row["email"];
                $firstname = $row["fullname"];
                $lastname = $row["surname"];
                $is_verified = $row["verified"];
                $notifications = $row["notifications"];
                $hashed_password = $row["password"];
                if("1" == "1"){
                    // Password is correct, so start a new session
                    session_start();
                    $password_err = "DAMN";
                    // Store data in session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $id;
                    $_SESSION["username"] = $username;
                    $_SESSION["email"] = $user_email;
                    $_SESSION["verified"] = $is_verified;
                    $_SESSION["notifications"] = $notifications;
                    $_SESSION["firstname"] = $firstname;
                    $_SESSION["surname"] = $lastname;
                    // Redirect user to welcome page
                    //header("location: profile.php");
                }
            }
        }
 
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
}
                
?>