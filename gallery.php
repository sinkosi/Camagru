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
// Get images from the database
$query = $dbn->query("SELECT * FROM images ORDER BY uploaded_on DESC");

if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $imageURL = 'images/'.$row["source"];

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
include('footer.php')
?>