<?php
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