<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once ('config/createConnection.php');

session_start();

if (isset($_GET['imageid']) && $_GET['userid'] === $_SESSION['id']){
    $imageid = $_GET['imageid'];
    $userid = $_SESSION['id'];
    //$sql = "INSERT INTO likes (userid, imageid) VALUES ('".$userid."', '".$imageid."')";
    try{
        $sql = "INSERT INTO likes (userid, imageid)
                    SELECT {$userid}, {$imageid}
                    FROM images
                    WHERE EXISTS (
                        SELECT imageid
                        FROM images
                        WHERE imageid = {$imageid})
                    AND NOT EXISTS (
                        SELECT userid
                        FROM likes
                        WHERE userid = {$userid}
                        AND imageid = {$imageid})
                    LIMIT 1";
        $stmt = $conn->prepare($sql);
        if($stmt->execute()){
            $sql = "SELECT user.userid, user.username, user.notifications, user.email, images.imageid, images.source FROM user, images WHERE user.userid = images.userid";
            $stmt = $conn->prepare($sql);
            }else{
                echo "ERROR";
            }
            if ($stmt->execute() && $stmt->rowCount() > 0){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                //echo "<pre>" . print_r($row) . "<pre>";
                if($row['notifications'] == 1){
                    mail($row['email'], $_SESSION['username']." Liked your picture", 
                    "Your picture posted on Camagru was LIKED by ".$_SESSION['username']);
                }
            }
        header ("location: gallery.php");
        //echo ('<script>alert("IM SET");</script>');
    }catch(PDOException $e){
        echo $sql . "<br>" . $e.getMessage();
        $statusMsg = "File upload failed, please try again.";
    }
}else{
    echo ('<script>alert("Error transmitting like, Please go back");</script>');
}


?>