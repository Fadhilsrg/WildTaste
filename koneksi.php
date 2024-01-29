<?php

$host = "localhost";
$dbname = "WildTaste";
$username = "root";  // Ganti dengan nama pengguna MySQL Anda
$password = "";      // Ganti dengan kata sandi MySQL Anda

try {
    // Menggunakan PDO MySQL
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>
