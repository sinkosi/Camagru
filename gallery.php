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
//define results per page
$results_per_page = 5;

//find the number of results stored in database
$sql = "SELECT * FROM images";
$result = mysqli_query($db, $sql);
$number_of_results = mysqli_num_rows($result);
$number_of_pages = ceil($number_of_results / $results_per_page);

//determine which page number visitor is currently on
if (!isset($_GET['page'])){
    $page = 1;
} else {
    $page = $_GET['page'];
}

/*TUTORIAL ON LIKES TEST*/
$likesQuery = $dbn->query("
    SELECT
    images.imageid,
    COUNT(likes.imageid) AS likes

    FROM images

    LEFT JOIN likes
    ON images.imageid = likes.imageid

    GROUP BY images.imageid
    ");
//$like = array();
/*$stmt = $pdo->prepare("SELECT * FROM table WHERE value=?, ?");
$stmt->execute(array());
$stmt->execute();
while($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    $row['likes'];
}
*/
while($likes_row = $likesQuery->fetch_object()){
    $likes[] = $likes_row;
}
//$array = json_decode(json_encode($likes), True);
//var_dump($likes);
//echo '<pre', print_r($likes), '</pre>';

if (is_array($likes)){
    echo '<pre>', print_r($likes), '<pre>';
}
else {
    //get_class_vars($likes->imageid);
    //var_dump($likes);
}
//echo '<pre', print_r($likes), '</pre>';

//echo '<pre', print_r($array), '</pre><br>';



//determine the sql Start LIMIT number
$this_page_first_result = ($page-1)*$results_per_page;

//retrieve selected results from database and display them on page
$sql = "SELECT * FROM images ORDER BY uploaded_on DESC LIMIT " . $this_page_first_result . ',' . $results_per_page ;
/*$sql = "SELECT images.imageid, images.source, images.userid
 ORDER BY uploaded_on DESC LIMIT " . $this_page_first_result . ',' . $results_per_page ;
*/
$result = mysqli_query($db, $sql);

if ($result){
    while ($row = mysqli_fetch_array($result)){// && $com_row = mysql_fetch_assoc($find_comments)){
        $imageURL ='images/'.$row['source'];

        //$comment_name = $com_row['userid'];
        //$comment = $com_row['text'];
        

/*// Get images from the database
$query = $dbn->query("SELECT * FROM images ORDER BY uploaded_on DESC");
//$query = $dbn->query("SELECT * FROM images LIMIT 5");
if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $imageURL = 'images/'.$row["source"];
*/
/*$find_comments = mysql_query("SELECT * FROM comments");
if ($find_comments > 0){
    while ($com_row = mysqli_fetch_array($find_comments)){
        $comment_name = $com_row['userid'];
        $comment = $com_row['text'];
*/
    //echo "$comment_name - $comment<p>";

?>

    <img src="<?php echo $imageURL; ?>" alt="" height="320" width=""/>
    <form action="comment.php" method="POST">
        <input type="hidden" name="imageid" value="<?php echo $row['imageid'] ?>">
        <input type="hidden" name="date" value="">
        <textarea name="comment" cols="50" rows="2">Enter a comment</textarea><br>
        <a href="like.php?userid=<?php echo $_SESSION['id']?>&imageid=<?php echo $row['imageid']; ?>">Like</a>
        <input type="submit" name="submit" value="Comment"></button>
    </form>
    <p><?php echo $likes['likes']; ?> people like this</p>
    <p>No comments yet, be the first to post <?php echo $row['source']; ?></p>
<?php }
}else{ ?>
    <p>No image(s) found...</p>
<?php }
//display the links to the page
for ($page=1;$page<=$number_of_pages;$page++) {
    echo '<a href="gallery.php?page=' . $page . '">' . $page . "</a>";
}
include('footer.php')
?>
