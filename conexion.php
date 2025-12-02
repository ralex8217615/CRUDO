<?php
$host = "localhost";
$port = "5432";          // Puerto por defecto de PostgreSQL
$db   = "crud";          // Tu base de datos en PostgreSQL
$user = "postgres";      // Usuario por defecto de pgAdmin
$pass = "331213"; // <-- pon tu contraseña real de pgAdmin

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
