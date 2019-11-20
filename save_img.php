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

/*function RandomString()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 10; $i++) {
        $randstring = $characters[rand(0, strlen($characters))];
    }
    return $randstring;
}

RandomString();*/

$img_name = $_SESSION["username"].date("Y-m-d H:i:s").'.png';
$img = base64_decode($_POST["img"]);
$img = imagecreatefromstring($img);
imagepng($img, "images/".$img_name);

/*$fileName = RandomString().'.png';
echo $fileName;*/

$insert = $db->query("INSERT into images (source, userid, uploaded_on) VALUES ('".$img_name."', '".$_SESSION["id"]."', NOW())");
                
    if($insert){
        $statusMsg = "The file ".$img_name. " has been uploaded successfully by ".($_SESSION["username"]).".";
    }else{
        $statusMsg = "File upload failed, please try again.";
    }
    echo $statusMsg;
?>