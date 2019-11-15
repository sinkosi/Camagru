<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>WEBCAM</title>
</head>
<body>
    <?php include('header.php') ?>
    <br>
    <br>
<!--Stream video via webcam-->
    <div class="video-wrap">
        <video id="video" playsinline autoplay></video>
    </div>
    <!--Trigger canvas Web API-->
    <div class="controller">
        <button id="snap">Capture</button>
        <button id="retry">Retry</button>
        <button id="save">Save</button>
    </div>
    <!-- Webcam video snapshot-->
    <canvas id="canvas" width="640" height="480"></canvas>
    <script>
    'use strict';
    
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const snap = document.getElementById('snap');
    const errorMsgElement = document.getElementById('spanErrorMsg');
    var photo = null;

    const constraints = {
        audio: false,
        video:{
            width:640, height: 480
        }
    };
    //Access webcam
    async function init(){
        try{
            const stream = await navigator.mediaDevices.getUserMedia(constraints);
            handleSuccess(stream);
        }
        catch(e){
            errorMsgElement.innerHTML = 'navigator.getUserMedia.error:${e.toString()}';
        }
    }
    
    // Success
    function handleSuccess(stream){
        window.stream = stream;
        video.srcObject = stream;
    }
    // Load init
    init();
    //Draw Image
    var context = canvas.getContext('2d');
    snap.addEventListener("click", function(){
        context.drawImage(video, 0, 0, 640, 480);
    });
    // //Save Image
/*    var save_img = document.getElementById("save");
    save.addEventListener("click", ()=>{
        var data = canvasElement.toDataURL();
        data = data.replace("data:image/png;base64,","");
        var request = newXMLHttpRequest();

        request.onload = () => {
            console.log(request.responseText, request);
        }
        request.open("POST","/Camagru/save_img.php");
        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        request.send("img=" + encodeURIComponent(data));
    });*/

    });


    </script>
    <?php 
    $data = photo;
    
    list($type, $data) = explode(';', $data);
    list(, $data) = explode(',', $data);
    $data = base64_decode($data);

    file_put_contents('images/image.png', $data);
    ?>
    <?php include('footer.php') ?>
</body>
</html>