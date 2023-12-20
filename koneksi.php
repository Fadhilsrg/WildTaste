<?php
$host = 'localhost';
$port = '5432';
$dbname = 'WildTaste';
$user = 'postgres';
$password = 'postgres';

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";

try {
    $dbh = new PDO($dsn);
    echo "Koneksi berhasil!";
} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}
?>