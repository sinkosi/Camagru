<?php

require('./createConnection.php');

try {
/*        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);*/
        $sql = "INSERT INTO c_user (username, password_plain, email, fullname, surname)
        VALUES ('thoko', 'Mokoena','new@email.co.za','Thoko', 'Mokoena')";
        $conn->exec($sql);
        $sql = "INSERT INTO c_user (username, password_plain, email, fullname, surname)
        VALUES ('tshidi', 'tshidi12345','tshidi@email.co.za','Tshidi', 'Suhayl')";
        $conn->exec($sql);
        $sql = "INSERT INTO c_user (username, password_plain, email, fullname, surname)
        VALUES ('maria', 'ngwana','maria@email.co.za','Maria', 'Santana')";
        $conn->exec($sql);
        $sql = "INSERT INTO c_user (username, password_plain, email, fullname, surname)
        VALUES ('jade', 'eatmyshorts','jade@email.co.za','Jade', 'Akiss')";
        $conn->exec($sql);
        $sql = "INSERT INTO c_user (username, password_plain, email, fullname, surname)
        VALUES ('simphiwe', 'him','simza@email.co.za','Simphiwe', 'Gogwakho')";
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