<?php
$server_name = "localhost";
$username = "root";
$password = "";
$dbname = "shoppingsite";
try {
    $conn = new PDO("mysql:host=$server_name;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
// $conn=null;
