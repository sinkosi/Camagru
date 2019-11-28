<?php

require('./createConnection.php');

$password0 = password_hash('thoko12345', PASSWORD_DEFAULT);
$password1 = password_hash('tshidi12345', PASSWORD_DEFAULT);
$password2 = password_hash('maria12345', PASSWORD_DEFAULT);
$password3 = password_hash('jade12345', PASSWORD_DEFAULT);
$password4 = password_hash('shimza12345', PASSWORD_DEFAULT);

$vc0 = hash('whirlpool', rand(0, 10000));
$vc1 = hash('whirlpool', rand(0, 10000));
$vc2 = hash('whirlpool', rand(0, 10000));
$vc3 = hash('whirlpool', rand(0, 10000));
$vc4 = hash('whirlpool', rand(0, 10000));

try {
    
/*        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);*/
        $sql = "INSERT INTO user (username, password, email, fullname, surname, vc)
        VALUES ('thoko', '".$password0."','thoko@mailinator.com','Thoko', 'Mokoena', '".$vc0."')";
        $conn->exec($sql);
        $sql = "INSERT INTO user (username, password, email, fullname, surname, vc)
        VALUES ('tshidi', '".$password1."','tshidi@mailinator.com','Tshidi', 'Suhayl', '".$vc1."')";
        $conn->exec($sql);
        $sql = "INSERT INTO user (username, password, email, fullname, surname, vc)
        VALUES ('maria', '".$password2."','maria@mailinator.com','Maria', 'Santana', '".$vc2."')";
        $conn->exec($sql);
        $sql = "INSERT INTO user (username, password, email, fullname, surname, vc)
        VALUES ('jade', '".$password3."','jade@mailinator.com','Jade', 'Akiss', '".$vc3."')";
        $conn->exec($sql);
        $sql = "INSERT INTO user (username, password, email, fullname, surname, vc)
        VALUES ('shimza', '".$password4."','simza@mailinator.com','Simphiwe', 'Gogwakho', '".$vc4."')";
        //Use exec() because no results are returned
        $conn->exec($sql);
        // echo ".$user_name.";
        //echo "New record created successfully";
        }
    catch(PDOException $e)
        {
        echo $sql . "<br>" . $e->getMessage();
        }

    $conn = null;

?>