<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include ('./config/createConnection.php');

session_start();

$imageid = $_POST['imageid'];
$comment = htmlspecialchars($_POST["comment"]);
$userid = $_SESSION["id"];


$comment_len = strlen($comment);

if($comment_len > 100){
    header("location: gallery.php?error=1");
} else {
try {
    $sql = "INSERT INTO comments (userid, imageid, text) 
        VALUES ('".$userid."', '".$imageid."', '".$comment."')";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute()){
    $sql = "SELECT user.userid, user.username, user.notifications, user.email, images.imageid, images.source FROM user, images WHERE user.userid = images.userid";
    $stmt = $conn->prepare($sql);
    }else{
        echo "ERROR";
    }
    if ($stmt->execute() && $stmt->rowCount() > 0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        //echo "<pre>" . print_r($row) . "<pre>";
        if($row['notifications'] == 1){
            mail($row['email'], $_SESSION['username']." commented on your picture", 
            "Your picture posted on Camagru was commented on by ".$_SESSION['username']." - ".$comment);
        }
    }
    header("location: gallery.php?success=1");
}
catch(PDOException $e)
        {
        echo $sql . "<br>" . $e->getMessage();
        header("location: gallery.php?success=0&injection=0");
        }

$conn = null;
}
//echo "FAIL"
?>