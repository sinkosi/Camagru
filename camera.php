<?php

?>

<!DOCTYPE html>
 <html>
    <head>
        <title>Camagru - Camera</title>
        <link rel="stylesheet" type="text/css" href="View/stylesheet.css">

    </head>
    <body>
        <!--?php include('header.php') ?>
        <br>
        <input type="file" accept="image/*;capture=camera">
        <br>
        <br>
        <h3>This is where we get the camera</h3>-->
        <div id="camera">
            <video autoplay="true" id="cameraElement">
            </video>
        </div>
        <script type="text/javascript">
            var video=document.querySelector("#cameraElement");
            navigator.getUserMedia=navigator.getUserMedia||navigator.webkitGetUserMedia||navigator.mozGetUserMedia||navigator.msGetUserMedia||navigator.oGetUserMedia;
            if(navigator.getUserMedia) {
                navigator.getUserMedia({video:true},handleVideo,videoError);
            }
            function handleVideo(stream){
                video.src=window.URL.createObjectURL(stream);
            }
            function videoError(e){

            }
        </script>
    </body>
</html>