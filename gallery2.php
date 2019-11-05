<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Include the database configuration file
include './config/createConnection.php';
require './config/database.php';

include('header.php');
// Get images from the database
$query = $dbn->query("SELECT * FROM images ORDER BY uploaded_on DESC");

if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $imageURL = 'images/'.$row["file_name"];

?>

    <img src="<?php echo $imageURL; ?>" alt="" height="320" width=""/>
<?php }
}else{ ?>
    <p>No image(s) found...</p>
<?php } ?>