<?php
$header_status = 'My Profile';
$head_address = 'profile.php';

// Initialize the session
//session_start();
// Check if the user is logged in, if not then redirect him to login page
$curr_name = '';
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
   $header_status = 'Register';
   $head_address = 'register.php';
   $curr_name = "GUEST";
}
else{
	$curr_name = $_SESSION["username"];
	
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="View/stylesheet.css">
</head>
<header>
    <div class="clear"></div>
		<div id="menu-bar-container">
			<div id="menu-bar">
				<h1 href="index.php">Camagru</h1>
				<div id="menu-bar-top-right">
					<a href="profile.php"><?php echo htmlspecialchars($curr_name); ?></a>
					<!--a href="profile.php"><?php echo htmlspecialchars($_SESSION["username"]); ?></a-->
					<a href="profile.php"><img src="BBC Practice/images/grunt.png"></a>
				</div>
			</div>
			<div class="clear"></div>
			<div id="menu-bar-2-container">
				<div id="menu-bar-2">
					<a href="index.php">Home</a>
					<a href="email.php">EMAIL</a>
					<a href="login.php">Login</a>
					<a href="camera.php">Camera Test</a>
					<a href="#">Welcome Page</a>
					<a href="upload.php">Upload</a>
					<a href="gallery.php">Gallery</a>
					<a href="contact.php">Contact Us</a>
					<a href="<?php echo $head_address;?>"><?php echo $header_status; ?></a>
				</div>
			</div>
		</div>
</header>

</html>