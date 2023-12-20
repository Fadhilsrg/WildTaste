<?php
    require 'koneksi.php'; // Assuming this file contains your database connection details

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Using PDO to connect to PostgreSQL
        try {
            $conn = new PDO("pgsql:host=localhost;dbname=WildTaste", "postgres", "postgres");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Using prepared statement to prevent SQL injection
            $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE username = :username AND password = :password");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);

            $stmt->execute();

            // Checking if there is a matching row
            if ($stmt->rowCount() > 0) {
                header("Location: /UASWeb/WildTaste/LandingPage/");
            } else {
                echo "<center><h1>Email atau Password Salah. Silahkan Coba Kembali</h1>
                <button><strong><a href='login.html'>Retry</a></strong></button></center>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
    }
 }
?>
