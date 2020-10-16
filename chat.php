<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
include './config/createConnection.php';
require './config/database.php';
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}


try {
    $conn2 = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    // set the PDO error mode to exception
    $conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

$sql2 = "SELECT * FROM chat ORDER by id DESC";



?>

<script>
function submitChat(){
    /*Ensure input is full filled out or exit && alert!*/
    if(chat.msg.value == ''){
        alert('All Fields Are Mandatory!');
        return;
    }

    //If values are filled then the variables are saved
    //var uname = chat.uname.value;
    var msg = chat.msg.value;

    //Create http Request instance
    var xmlhttp = new XMLHttpRequest();

    //Create class for request to use with insert.php
    xmlhttp.onreadystatechange = function(){
        if(xmlhttp.readyState==4&&xmlhttp.status==200){
            document.getElementById('chatlogs').innerHTML = xmlhttp.responseText;
        }
    }
    //Open and Send http request
    xmlhttp.open('GET', 'chatinsert.php?msg='+msg, true);
    xmlhttp.send;

}
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Camagru: Chat</title>
</head>
<body>
    <?php include('header.php') ?>
    <br />
    <br />
    <form method="get" name="chat" action="chatinsert.php">
        Chatting as: <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b><br /><!--input type="text" name="uname" /><br /-->
        Your Message: <br />
        <textarea name="msg"></textarea><br />
        <!--a href="" onclick="submitChat()">Send</a><br /><br /-->
        <br>
        <input type="submit" value="Send" onClick="submitChat()">
        <div id="chatlogs">
        <?php if ($result1 = $conn2->prepare($sql2)){
                if ($result1->execute() && $result1->rowCount() > 0){
                    while($extract = $result1->fetch(PDO::FETCH_ASSOC)){
                        echo $extract['username'] . ": " . $extract['message'] . "<br>";
                    }
                }
            } ?>
        </div>
    </form>
    <?php include('footer.php') ?>
</body>
</html>
