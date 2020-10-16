<?php
//setcookie('CSS_Cookie', 'http://bootstrapcdn.com/', time()+86400);
include './config/createConnection.php';
require './config/database.php';
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    $_SESSION["username"] = "GUEST";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <?php include('header.php') ?>
    <br>
    <div class="page-header">
        <h3>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h3>
    </div>
    
    <hr>

<?php
// Get images from the database
try{
    $sql = "SELECT * FROM images ORDER BY uploaded_on DESC LIMIT 20";
    $stmt = $conn->prepare($sql);
    
    if ($stmt->execute() && $stmt->rowCount() > 0){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $imageURL = 'images/'.$row["source"];

?>

    <img src="<?php echo $imageURL; ?>" alt="" height="320" width=""/>
    
<?php }
}else{ ?>
    <p>No image(s) found...</p>
<?php
    
?>
<?php }
}catch(PDOException $e){
    $statusMsg = "Failed to load images, please try again.";
    echo $sql . "<br>" . $statusMsg . "<br>" . $e.getMessage();
}
?>
    
    <br>
    <br>
    <?php include('footer.php') ?>
    
</body>
</html>