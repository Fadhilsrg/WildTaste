<?php
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Using PDO to connect to PostgreSQL
    try {
        $conn = new PDO("pgsql:host=localhost;dbname=WildTaste", "postgres", "postgres");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Using prepared statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO tbl_user (username, email, password) VALUES (:username, :email, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

        $stmt->execute();

        header("Location: login.html");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
?>
