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

//determine the sql Start LIMIT number
$this_page_first_result = ($page-1)*$results_per_page;

//retrieve selected results from database and display them on page
$sql = "SELECT * FROM images ORDER BY uploaded_on DESC LIMIT " . $this_page_first_result . ',' . $results_per_page;
$result = mysqli_query($db, $sql);

if ($result > 0){
    while ($row = mysqli_fetch_array($result)){
        $imageURL ='images/'.$row['source'];   


/*// Get images from the database
$query = $dbn->query("SELECT * FROM images ORDER BY uploaded_on DESC");
//$query = $dbn->query("SELECT * FROM images LIMIT 5");
if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $imageURL = 'images/'.$row["source"];
*/
?>

    <img src="<?php echo $imageURL; ?>" alt="" height="320" width=""/>
    <form>
        <input type="hidden" name="uid" value="currUser">
        <input type="hidden" name="date" value="">
        <textarea name="message"></textarea><br>
        <button type="submit" name="submit">Comment</button>
    </form>
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
