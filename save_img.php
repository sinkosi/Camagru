<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
//Session starts to obtain user
session_start();

//Include the database files for connection
include './config/createConnection.php';
require './config/database.php';

$statusMsg = '';

$img_name = $_SESSION["username"].date("Ymd-His").'.png';
$img = base64_decode($_POST["img"]);
$img = imagecreatefromstring($img);
imagepng($img, "images/".$img_name);

try{
    $sql = "INSERT into images (source, userid, uploaded_on)
        VALUES ('".$img_name."', '".$_SESSION["id"]."', NOW())";
    $conn->exec($sql);
    $statusMsg = "The file ".$img_name. " has been uploaded successfully by ".($_SESSION["username"]).".";
}catch(PDOException $e){
    echo $sql . "<br>" . $e.getMessage();
    $statusMsg = "File upload failed, please try again.";
}
echo $statusMsg;

?>