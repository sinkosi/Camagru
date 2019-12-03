<?php
include_once('config/database.php');
$conn = connectiondb();
if (isset($_POST['comment']))
{
	session_start();
	$imgid = $_POST['comment'];
	$userid = $_SESSION['id'];
	$post = $_POST['message'];
	$sql = $conn->prepare("INSERT INTO camagru.comments(imageid,userid,posts) VALUE(?,?,?)");
	$arr = array($imgid,$userid,$post);
	if($sql->execute($arr) === TRUE)
	{
		$check = "SELECT email FROM user Where id=?";
		$query = $conn->prepare($check);
		$query->execute([$userid]);
		$e = $query->fetch(PDO::FETCH_ASSOC);
		if (!empty($e))
		{
			$sub = "comment";
			$msg = "$username commented on your picture $post";
			mail($e['email'],$sub,$msg,'MIME-Version: 1.0\r\nContent-type: text/html;charset=UTF-8'.'From: <no-reply@camagru.co.za>');		
		}
	}
}
header("location: gallery.php");
?>