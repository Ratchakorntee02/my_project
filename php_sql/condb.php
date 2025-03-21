<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_project";

try {
    $condb = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    // set the PDO error mode to exception
    $condb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully"; // Uncomment for debugging
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>