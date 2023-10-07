<?php

$host = "sql12.freemysqlhosting.net";
$dbname = "sql12651612";
$username = "sql12651612";
$password = "fpmXrqnijB";

$conn = mysqli_connect($host, $username, $password, $dbname);

if(!$conn) {
    echo "Databse is not connected";
    exit();
}


$lowerTableName = 'xyz';

$tableCheckQuery = "SHOW TABLES LIKE '$lowerTableName'";
$tableExistsResult = mysqli_query($conn, $tableCheckQuery);
$tableExists = mysqli_num_rows($tableExistsResult); 

if (!$tableExists) {
    $createTableQuery = "
    CREATE TABLE $lowerTableName (
        id INT AUTO_INCREMENT PRIMARY KEY,
        event_name VARCHAR(255) NOT NULL,
        start_time VARCHAR(255) NOT NULL,
        end_time VARCHAR(255) NOT NULL,
        location VARCHAR(255) NOT NULL,
        description VARCHAR(1000),
        category VARCHAR(255),
        banner_image VARCHAR(500)
    )";
    mysqli_query($conn, $createTableQuery);
}
