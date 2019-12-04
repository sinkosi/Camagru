<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include ('./config/createConnection.php');

session_start();

$imageid = $_POST['imageid'];
$comment = $_POST["comment"];
$userid = $_SESSION["id"];


$comment_len = strlen($comment);

if($comment_len > 100){
    header("location: gallery.php?error=1");
} else {
try {
    $sql = "INSERT INTO comments (userid, imageid, text) 
        VALUES ('".$userid."', '".$imageid."', '".$comment."')";
    $conn->exec($sql);
    
    header("location: gallery.php?success=1");
}
catch(PDOException $e)
        {
        echo $sql . "<br>" . $e->getMessage();
        }

$conn = null;
}
//echo "FAIL"
?>