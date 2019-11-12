<?php

include ('./createDB.php');
require ('./database.php');

try {
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // sql to create table
    //CREATE USER TABLE
    $sql = "CREATE TABLE IF NOT EXISTS user (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(25) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    /*password VARCHAR(255) NOT NULL,*/
    picturesource VARCHAR(255),
    verified tinyint(1) NOT NULL DEFAULT '0',
    notifications tinyint(1) NOT NULL DEFAULT '1',
    email VARCHAR(100) NOT NULL UNIQUE,
    fullname VARCHAR(50) NOT NULL,
    surname VARCHAR(50) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
    $conn->exec($sql);
/*
    //IMAGE TABLE CREATION BACK UP COMMENT
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE IF NOT EXISTS image (
    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    source VARCHAR(255) NOT NULL,
    uploaded_on datetime NOT NULL,
    //uploaded_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    userid INT(6) UNSIGNED NOT NULL,
    FOREIGN KEY (userid) REFERENCES user(id)
    )";
    $conn->exec($sql);
    // use exec() because no results are returned
  */  

    //IMAGES TABLE CREATION
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE IF NOT EXISTS images (
    id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    source VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
    uploaded_on datetime NOT NULL,
    status enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
    userid INT(6) UNSIGNED NOT NULL,
    FOREIGN KEY (userid) REFERENCES user(id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
    $conn->exec($sql);

    //COMMENT TABLE CREATION
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE IF NOT EXISTS comments (
    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    userid INT(6) UNSIGNED,
    imageid INT(11) UNSIGNED NOT NULL,
    text VARCHAR(100) NOT NULL,
    FOREIGN KEY (userid) REFERENCES user(id),
    FOREIGN KEY (imageid) REFERENCES images(id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
    $conn->exec($sql);
    // use exec() because no results are returned

    //LIKE TABLE CREATION
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE IF NOT EXISTS likes (
    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    userid INT(6) UNSIGNED NOT NULL,
    imageid INT(10) UNSIGNED NOT NULL,
    text VARCHAR(100) NOT NULL,
    FOREIGN KEY (userid) REFERENCES user(id),
    FOREIGN KEY (imageid) REFERENCES images(id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
    $conn->exec($sql);


    echo "Tables created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>