<?php
session_start();

require_once "./config/createConnection.php";

$id = $_SESSION["id"];
$sql = "DELETE FROM user WHERE user.userid = :id";
$conn->exec($sql);
header("location: index.php");
?>