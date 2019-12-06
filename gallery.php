<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

$conn2 = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    // set the PDO error mode to exception
$conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$conn3 = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    // set the PDO error mode to exception
$conn3->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//retrieve selected results from database and display them on page
try{
    $sql = "SELECT user.userid, user.username, user.notifications, user.verified, user.email, images.imageid, images.source FROM user, images WHERE user.userid = images.userid ORDER BY uploaded_on DESC LIMIT ".$this_page_first_result . ',' . $results_per_page ;
    //$sql = "SELECT * FROM images ORDER BY uploaded_on DESC LIMIT " . $this_page_first_result . ',' . $results_per_page ;
    //$sql = "SELECT * FROM user, images WHERE user.userid = images.userid ";// JOIN SELECT * FROM comments, likes WHERE comments.imageid = likes.imageid";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute() && $stmt->rowCount() > 0){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            //echo "<pre>" . print_r($row) . "<pre>";
            $imageURL ='images/'.$row['source'];
            $likesQuery = "SELECT COUNT(imageid) FROM likes WHERE imageid = :imageid";// COUNT(likes.imageid) AS likes";
            $likes = $conn2->prepare($likesQuery);
            $likes->bindParam(":imageid", $row['imageid'], PDO::PARAM_INT);
            if($likes->execute()){
                $like_row = $likes->fetch(PDO::FETCH_ASSOC);
            }
            $commentQuery = "SELECT userid, username, imageid, text FROM comments WHERE imageid = :imageid";
            $comms = $conn3->prepare($commentQuery);
            $comms->bindParam(":imageid", $row['imageid'], PDO::PARAM_INT);
            $comm_out = "No comments yet, be the first to post";
            if ($comms->execute() && $comms->rowCount() > 0){
                //echo '<script>alert("IM HERE")</script>';
                while($comms_row = $comms->fetch(PDO::FETCH_ASSOC)){
                    //echo "<pre>" . print_r($comms_row) . "<pre>";
                    $comm_out = $comms_row['username'] . " - " . $comms_row['text'] . "<br>";
                }
            }

?>

    <img src="<?php echo $imageURL; ?>" alt="" height="320" width=""/>
    <form action="comment.php" method="POST">
        <input type="hidden" name="imageid" value="<?php echo $row['imageid'] ?>">
        <input type="hidden" name="date" value="">
    <?php if($_SESSION['verified'] === "1") :?>
        <textarea name="comment" cols="50" rows="2">Enter a comment</textarea><br>
    <?php endif; ?>
    <?php if($row['userid'] === $_SESSION['id']) :?>
        <a onClick="return confirm('Are you sure you want to delete this image?')" href="delete_img.php?imageid=<?php echo $row['imageid'];?>">Delete</a>
    <?php endif; ?>
    <?php if($_SESSION['verified'] === "1") :?>
        <a href="like.php?userid=<?php echo $_SESSION['id']?>&imageid=<?php echo $row['imageid']; ?>">Like</a>
        <input type="submit" name="submit" value="Comment"></button>
    <?php endif; ?>
    </form>
    <p><?php echo $like_row['COUNT(imageid)']; ?> people like this</p>
    <p><?php echo $comm_out; ?></p>
<?php }
}else{ ?>
    <p>No image(s) found...</p>
<?php }
//Catch ME Outside
}catch(PDOException $e){
    $statusMsg = "Failed to load images, please try again.";
    //echo $sql . "<br>" . $statusMsg . "<br>" . $e.getMessage();
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
/*TUTORIAL ON LIKES TEST*/
/*$likesQuery = $dbn->query("
    SELECT
    images.imageid,
    COUNT(likes.imageid) AS likes

    FROM images

    LEFT JOIN likes
    ON images.imageid = likes.imageid

    GROUP BY images.imageid
    ");*/
?>
