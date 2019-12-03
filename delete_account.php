<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require_once "./config/createConnection.php";

$id = $_SESSION["id"];
//DELETE FROM IMAGES
$sql = "DELETE FROM images WHERE userid = :id";
//print_r($stmt);
$stmt = $conn->prepare($sql);
$stmt->bindParam(":id", $param_id, PDO::PARAM_STR);
$stmt->execute([':id' => $id]);

//DELETE FROM USER
$sql = "DELETE FROM user WHERE userid = :id";
//print_r($stmt);
$stmt = $conn->prepare($sql);
$stmt->bindParam(":id", $param_id, PDO::PARAM_STR);
$stmt->execute([':id' => $id]);
//$conn->exec($sql);
header("location: logout.php");
?>