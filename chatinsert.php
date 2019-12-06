<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
$userid = $_SESSION['id'];
$username = $_SESSION['username'];
$msg = htmlspecialchars($_GET['msg']);

include './config/createConnection.php';
if (empty($msg))
{
    echo "<script>alert('All Fields Are Mandatory!');</script>";
    header ("location: chat.php?NULL=1");
}
$sql = "INSERT INTO chat (userid, username, message) VALUES
    (:userid, :username, :message)";

if ($stmt = $conn->prepare($sql)){
    $stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    $stmt->bindParam(":message", $msg, PDO::PARAM_STR);
    try{
        $stmt->execute();
        header ("location: chat.php");
    }catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
}


?>