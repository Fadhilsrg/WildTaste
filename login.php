<?php
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Set session variable
            $_SESSION["loggedin"] = true;
            header("Location: /WildTaste/LandingPage/index.php");
        } else {
            echo "<center><h1>Email atau Password Salah. Silahkan Coba Kembali</h1>
                <button><strong><a href='login.html'>Retry</a></strong></button></center>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
