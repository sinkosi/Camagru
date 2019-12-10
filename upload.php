<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include the database configuration file
include './config/createConnection.php';
//require './config/database.php';

$statusMsg = '';

// File upload path
$targetDir = "images/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

$div = explode('.', $fileName);
$file_ext = strtolower(end($div));
//$fileName = substr(md5(time()), 0, 10).'.'.$file_ext;
$fileName = $_SESSION["username"].date("Ymd-His").'.'.$file_ext;//.date("Y-m-d H:i:s");
$targetFilePath = $targetDir . $fileName;

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            try{
                $sql = "INSERT into images (source, userid, uploaded_on) 
                    VALUES ('".$fileName."', '".$_SESSION["id"]."', NOW())";
                $conn->exec($sql);
                $statusMsg = "The file ".$fileName. " has been uploaded successfully by ".($_SESSION["username"]).".";
            }catch(PDOException $e){
                $statusMsg = "File upload failed, please try again.";
                echo $sql . "<br>" . $statusMsg . "<br>" . $e->getMessage();
            }
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}

// Display status message
//echo $statusMsg;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload</title>
</head>
<body>
    
    <?php include('header.php') ?>

    <br><?php echo $statusMsg ?><br>
    <div class="wrapper">
        <h2>Upload Files</h2>
        <p>Please Upload an image using the special below</p>
        <form action="upload.php" method="post" enctype="multipart/form-data">
        Select Image File to Upload:
        <input type="file" name="file">
        <br>
        <input type="submit" name="submit" value="Upload">
        </form>  
    </div>
    <br />
    <footer> 
        <?php include('footer.php') ?>
    </footer>
</body>
</html>