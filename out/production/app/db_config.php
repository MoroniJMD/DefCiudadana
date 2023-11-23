<?php
$servername = "localhost"; // Por ejemplo, "localhost"
$username = "root";
$password = "3J2D081326";
$dbname = "proyecto";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname,3306);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
