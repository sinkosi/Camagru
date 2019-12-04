<html>
<h1>Comment</h1>
</html>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include ('config/createConnection.php');
$sql = "SELECT * FROM comments";
$find_comments = mysqli_query($db, $sql);
while ($com_row = mysqli_fetch_assoc($find_comments)){
    $comment_name = $com_row['userid'];
    $imageid = $com_row['imageid'];
    $comment = $com_row['text'];

    echo htmlspecialchars("$comment_name - $imageid - $comment<p>");
    }


?>