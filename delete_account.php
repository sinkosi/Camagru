<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require_once "./config/createConnection.php";
try{
    $id = $_SESSION["id"];
    //DELETE FROM LIKES
    $sql = "DELETE FROM likes WHERE userid = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $param_id, PDO::PARAM_INT);
    $stmt->execute([':id' => $id]);

    //DELETE FROM COMMENTS
    $sql = "DELETE FROM comments WHERE userid = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $param_id, PDO::PARAM_INT);
    $stmt->execute([':id' => $id]);
    
    //DELETE FROM IMAGES
    $sql = "DELETE FROM images WHERE userid = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $param_id, PDO::PARAM_INT);
    $stmt->execute([':id' => $id]);

    //DELETE FROM USER
    $sql = "DELETE FROM user WHERE userid = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $param_id, PDO::PARAM_INT);
    $stmt->execute([':id' => $id]);
    //$conn->exec($sql);
    header("location: logout.php");
}catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage();
    $statusMsg = "Account delete failed, please try again.";
}
echo $statusMsg;
?>