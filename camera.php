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

include './config/createConnection.php';
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
<!--Sticker SAMPLES-->
    <div class="stickers" style="height: 30px">
        <img src="./resources/blank.png" alt="none" id="img0"/>
        <img src="./resources/pig.png" width="1" height="1" alt="pig" id="img1"/>
        <img src="./resources/cheese.png" width="1" height="1" alt="cheese" id="img2"/>
        <img src="./resources/flame.png" width="1" height="1" alt="flame" id="img4" />
        <img src="./resources/splash.png" width="1" height="1" alt="splash" id="img3" />
    </div>
    <br />
<!--Stream video via webcam-->
    <div class="video-wrap">
        <video id="video" playsinline autoplay></video>
    </div>
    <!--Trigger canvas Web API-->
    <div class="controller">
        <button id="snap">Capture</button>
        <button id="save">Save</button>
        <button id="clear">Clear</button>
        <label>Sticker Left</label>
        <select id="mySelect" size="1">
            <option selected="selected" value="img0">None</option>
            <option value="img1">Peppa Pig</option>
            <option value="img2">Cheese</option>
            <option value="img3">Splash</option>
            <option value="img4">Flame</option>
        </select>
        <label>Sticker Right</label>
        <select id="mySelect2" size="1">
            <option selected="selected" value="img0">None</option>
            <option value="img1">Peppa Pig</option>
            <option value="img2">Cheese</option>
            <option value="img3">Splash</option>
            <option value="img4">Flame</option>
        </select>
        <label>Sticker Bottom</label>
        <select id="mySelect3" size="1">
            <option selected="selected" value="img0">None</option>
            <option value="img1">Peppa Pig</option>
            <option value="img2">Cheese</option>
            <option value="img3">Splash</option>
            <option value="img4">Flame</option>
        </select>
    </div>
    <!-- Webcam video snapshot-->
    <canvas id="canvas" width="640" height="480"></canvas>

    
    <script>
    'use strict';
    
    //var mySticker = "img0";
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const snap = document.getElementById('snap');
    //const reset = document.getElementById('reset');
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
        var mySticker = mySticker_function();
        var mySticker2 = mySticker_function2();
        var mySticker3 = mySticker_function3();
        context.drawImage(video, 0, 0, 640, 480);
        context.drawImage(document.getElementById(mySticker), 0, 0, 150, 200);
        context.drawImage(document.getElementById(mySticker2), 430, 0, 150, 200);
        context.drawImage(document.getElementById(mySticker3), 240, 320, 150, 200);
        //context.drawImage(, 0, 0, 300, 30);
    });
    //Reset Image
    //var context = canvas.getContext('2d');
    document.getElementById('clear').addEventListener('click', function() {
        context.clearRect(0, 0, canvas.width, canvas.height);
      }, false);


    // //Save Image
    var save_img = document.getElementById("save");
    save.addEventListener("click", ()=>{
        var data = canvas.toDataURL();
        data = data.replace("data:image/png;base64,","");
        var request = new XMLHttpRequest();

    request.onload = () => {
        console.log(request.responseText, request);
    }
    request.open("POST","/Camagru/save_img.php");
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send("img=" + encodeURIComponent(data));
    window.location.reload();
    });

    function mySticker_function() {
        var x = document.getElementById("mySelect").value;
        return x;
    }
    function mySticker_function2() {
        var x = document.getElementById("mySelect2").value;
        return x;
    }
    function mySticker_function3() {
        var x = document.getElementById("mySelect3").value;
        return x;
    }

    </script>
    <?php
    $userid = $_SESSION["id"];
   $query = $dbn->query("SELECT * FROM images WHERE userid = '".$userid."' ORDER BY uploaded_on DESC");

    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
            $imageURL = 'images/'.$row["source"];

    ?>
    <br>
    <img src="<?php echo $imageURL; ?>" alt="" height="160" width=""/>
    <form>
        <input type="hidden" name="uid" value="currUser">
        <input type="hidden" name="date" value="">
    </form>
<?php }
}else{ ?>
    <p>No image(s) found...</p>
<?php }
    include('footer.php') 
?>
</body>
</html>