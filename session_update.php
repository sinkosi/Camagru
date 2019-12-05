<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Include config file
require_once "./config/createConnection.php";

$userid = $_SESSION["id"];
$username = $_SESSION["username"];

$sql = "SELECT userid, username, email, fullname, surname, verified, notifications, password FROM user 
        WHERE userid = :userid";
        
if($stmt = $conn->prepare($sql)){
    // Bind variables to the prepared statement as parameters
    $stmt->bindParam(":userid", $param_userid, PDO::PARAM_STR);
    
    // Set parameters
    $param_username = $_SESSION["username"];
    $param_userid = $_SESSION["id"];

    // Attempt to execute the prepared statement
    if($stmt->execute()){

        // Check if username exists, if yes then verify password
        if($stmt->rowCount() == 1){
            if($row = $stmt->fetch()){
                $id = $row["userid"];
                $username = $row["username"];
                $user_email = $row["email"];
                $firstname = $row["fullname"];
                $lastname = $row["surname"];
                $is_verified = $row["verified"];
                $notifications = $row["notifications"];
                $hashed_password = $row["password"];
                if(is_array($row)){
                    // Password is correct, so start a new session
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
    unset($conn);
}
                
?>