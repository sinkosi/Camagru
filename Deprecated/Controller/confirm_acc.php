<?php

include('./config/database.php')

function send_mail($address){
    
}

/*
//EMAIL THINGS
$checker = bin2hex(random_bytes(10));
$token = random_bytes(32);
$link = "http:localhost:8080/camagru/includes/signup.val.php?checker=" .$checker. "&validator=" .bin2hex($token)."&id=".$username;
// $expiry = date("U") + 900;
$message = "copy the link and past it in your browser: ".$link;
mail($mail,"Confirm your Email",$message);
echo '<script>alert("Registered Successfully. Please check your email for a verification link")</script>';
echo '<script>window.location="login.php"</script>';
*/
/*MORE EMAIL SHIT
$to = "sibonelo@live.co.za`";
$subject = "This is subject";

$message = "<b>This is HTML message.</b>";
$message .= "<h1>This is headline.</h1>";

$header = "From:abc@somedomain.com \r\n";
$header .= "Cc:afgh@somedomain.com \r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html\r\n";

$retval = mail ($to,$subject,$message,$header);

if( $retval == true ) {
echo "Message sent successfully...";
}else {
echo "Message could not be sent...";
}*/