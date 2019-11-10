
    //IMAGES TABLE CREATION
    $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE IF NOT EXISTS images (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    source VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
    uploaded_on datetime NOT NULL,
    status enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
    userid INT(6) UNSIGNED,
    FOREIGN KEY (userid) REFERENCES user(id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";