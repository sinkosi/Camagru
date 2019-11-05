
<!--?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;

}
?-->

<html>
    <head>
    <style>
    div.gallery {
    margin: 5px;
    border: 1px solid #ccc;
    float: left;
    width: 180px;
    }

    div.gallery:hover {
    border: 1px solid #777;
    }

    div.gallery img {
    width: 100%;
    height: auto;
    }

    div.desc {
    padding: 15px;
    text-align: center;
    }
    </style>
</head>
<body>
    <?php include('header.php') ?>
    <!--div class="gallery">
    <a target="_blank" href="./images/img0001.jpeg">
        <img src="./images/img0001.jpeg" alt="Cinque Terre" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
    </div>

    <div class="gallery">
    <a target="_blank" href="./images/img0002.jpg">
        <img src="./images/img0002.jpg" alt="Forest" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
    </div>

    <div class="gallery">
    <a target="_blank" href="./images/img0003.jpg">
        <img src="./images/img0003.jpg" alt="Northern Lights" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
    </div>

    <div class="gallery">
    <a target="_blank" href="./images/img0004.jpg">
        <img src="./images/img0004.jpg" alt="Mountains" width="600" height="400">
    </a>
    <div class="desc">Add a description of the image here</div>
    </div-->

    </body>
</html>