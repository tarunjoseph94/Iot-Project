<?php
//Cloud Database
$servername = "remotemysql.com";
$username = "w7d7KKX28F";
$password = "WS9rHsSbKI";
$dbname="w7d7KKX28F";
//Localhost
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname="iot";


// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
