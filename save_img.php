<?php
//Session starts to obtain user
session_start();

//Include the database files for connection
include './config/createConnection.php';
require './config/database.php';

$statusMsg = '';

//File Save Path
/*$targetDir = "images/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);*/



$img = base64_decode($_POST["img"]);
$img = imagecreatefromstring($img);
imagepng($img, "images/image.png");

$insert = $db->query("INSERT into images (source, userid, uploaded_on) VALUES ('image.png', '".$_SESSION["id"]."', NOW())");
                
    if($insert){
        $statusMsg = "The file ".$fileName. " has been uploaded successfully by ".($_SESSION["username"]).".";
    }else{
        $statusMsg = "File upload failed, please try again.";
    }
    echo $statusMsg;
?>