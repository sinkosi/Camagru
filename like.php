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
        $conn->exec($sql);
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