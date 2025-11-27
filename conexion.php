<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "crud";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
