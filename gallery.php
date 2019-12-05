<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include the database configuration file
include './config/createConnection.php';
require './config/database.php';

include('header.php');
?>

<br>
<?php

try{
    //define results per page
    $results_per_page = 5;

    //find the number of results stored in database
    $sql = "SELECT * FROM images";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $number_of_results = $stmt->rowCount();
    $number_of_pages = ceil($number_of_results / $results_per_page);
}catch(PDOException $e){
    echo $sql . "<br>";
}
//determine which page number visitor is currently on
if (!isset($_GET['page'])){
    $page = 1;
} else {
    $page = $_GET['page'];
}

//determine the sql Start LIMIT number
$this_page_first_result = ($page-1)*$results_per_page;

//retrieve selected results from database and display them on page
try{
    $sql = "SELECT * FROM images ORDER BY uploaded_on DESC LIMIT " . $this_page_first_result . ',' . $results_per_page ;
    $stmt = $conn->prepare($sql);

    if ($stmt->execute() && $stmt->rowCount() > 0){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $imageURL ='images/'.$row['source'];


?>

    <img src="<?php echo $imageURL; ?>" alt="" height="320" width=""/>
    <form action="comment.php" method="POST">
        <input type="hidden" name="imageid" value="<?php echo $row['imageid'] ?>">
        <input type="hidden" name="date" value="">
        <textarea name="comment" cols="50" rows="2">Enter a comment</textarea><br>
    <?php if($row['userid'] === $_SESSION['id']) :?>
        <a onClick="return confirm('Are you sure you want to delete this image?')" href="delete_img.php?imageid=<?php echo $row['imageid'];?>">Delete</a>
    <?php endif; ?>
        <a href="like.php?userid=<?php echo $_SESSION['id']?>&imageid=<?php echo $row['imageid']; ?>">Like</a>
        <input type="submit" name="submit" value="Comment"></button>
    </form>
    <p><?php// echo $likes['likes']; ?> people like this</p>
    <p>No comments yet, be the first to post <?php echo $row['source']; ?></p>
<?php }
}else{ ?>
    <p>No image(s) found...</p>
<?php }
//Catch ME Outside
}catch(PDOException $e){
    $statusMsg = "Failed to load images, please try again.";
    echo $sql . "<br>" . $statusMsg . "<br>" . $e.getMessage();
}
//display the links to the page
for ($page=1;$page<=$number_of_pages;$page++) {
    echo '<a href="gallery.php?page=' . $page . '">' . $page . "</a>";
}
include('footer.php');
/* GET COMMENTS
$find_comments = mysql_query("SELECT * FROM comments");
if ($find_comments > 0){
    while ($com_row = mysqli_fetch_array($find_comments)){
        $comment_name = $com_row['userid'];
        $comment = $com_row['text'];
*/
    //echo "$comment_name - $comment<p>";

?>
