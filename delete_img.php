<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if(isset($_GET['imageid'], $_SESSION)){
    $imageid = $_GET['imageid'];
    $id = $_SESSION['id'];
}else{
    header("location: gallery.php?DELETE_FAILED");    
}

require_once "./config/createCOnnection.php";

try{
    $sql = "SELECT * FROM images WHERE userid = :id AND imageid = :imageid";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->bindParam(":imageid", $imageid, PDO::PARAM_INT);

    if ($stmt->execute() && $stmt->rowCount() === 1){
        
        //DELETE FROM LIKES
        $sql = "DELETE FROM likes WHERE imageid = :imageid";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":imageid", $imageid, PDO::PARAM_INT);
        $stmt->execute();

        //DELETE FROM COMMENTS
        $sql = "DELETE FROM comments WHERE imageid = :imageid";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":imageid", $imageid, PDO::PARAM_INT);
        $stmt->execute();
        
        //DELETE FROM IMAGES
        $sql = "DELETE FROM images WHERE userid = :id AND imageid = :imageid";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":imageid", $imageid, PDO::PARAM_INT);
        $stmt->execute();
    }
    header("location: gallery.php");
    
}catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage();
    $statusMsg = "Account delete failed, please try again.";
}
//echo $statusMsg;

?>