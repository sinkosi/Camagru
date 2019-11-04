<?php

session_start();

include_once ('../config/createConnection.php');

if (isset($_POST["submit"]))
{
    $user_name = $_POST['user_name'];
    //$passwd = password_hash($_POST['passwd'], PASSWORD_DEFAULT);
    $passwd_plain = $_POST['passwd'];
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $surname = $_POST['surname'];

    try {
/*        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);*/
        /*$sql = "INSERT INTO c_user (username, password_plain, password, email, fullname, surname)
        VALUES ('".$user_name."', '".$passwd_plain."', '".$passwd."','".$email."','".$fullname."', '".$surname."')";*/
        
        $sql = "INSERT INTO c_user (username, password_plain, email, fullname, surname)
        VALUES ('".$user_name."', '".$passwd_plain."','".$email."','".$fullname."', '".$surname."')";

        //Use exec() because no results are returned
        $conn->exec($sql);
        // echo ".$user_name.";
        echo "New record created successfully";
        }
    catch(PDOException $e)
        {
        echo $sql . "<br>" . $e->getMessage();
        }

    $conn = null;
}
else
    echo "FAIL";
?>