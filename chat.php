<?php
include './config/createConnection.php';
require './config/database.php';
// Initialize the session
session_start();

?>

<script>
function submitChat(){
    /*Ensure input is full filled out or exit && alert!*/
    if(chat.uname.value == '' || chat.msg.value == ''){
        alert('All Fields Are Mandatory!');
        return;
    }

    //If values are filled then the variables are saved
    var uname = chat.uname.value;
    var msg = chat.msg.value;

    //Create http Request instance
    var xmlhttp = new XMLHttpRequest();

    //Create class for request to use with insert.php
    xmlhttp.onreadystatechange = function(){
        if(xmlhttp.readyState===4 && xmlhttp.status==200){
            document.getElementById('chatlogs').innerHTML = xmlhttp.responseText;
        }
    }
    //Open and Send http request
    xmlhttp.open('GET', 'insert.php?uname='+uname+'&msg='+msg, true);
    xmlhttp.send;
}
</script>

<html>

<head>
    <title>Camagru: Chat</title>
</head>
<body>
    <?php include('header.php') ?>
    <br />
    <br />
    <form name="chat">
        Chatting as: <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b><br /><!--input type="text" name="uname" /><br /-->
        Your Message: <br />
        <textarea name="msg"></textarea><br />
        <a href="#" onclick="">Send</a><br /><br />

        <div id="chatlogs">
            LOADING CHATLOGS PLEASE WAIT...
        </div>
    </form>
    <?php include('footer.php') ?>
</body>
</html>
