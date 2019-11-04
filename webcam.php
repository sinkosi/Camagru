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
    </div>
    <!-- Webcam video snapshot-->
    <canvas id="canvas" width="640" height="480"></canvas>
    <script>
    'use strict';
    
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const snap = document.getElementById('snap');
    const errorMsgElement = document.getElementById('spanErrorMsg');

    const constraints = {
        audio: false,
        video:{
            width:1280, height: 720
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
    </script>
    <?php include('footer.php') ?>
</body>
</html>