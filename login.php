<?php
    require 'koneksi.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"]; 
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query_sql = "SELECT * FROM tbl_user
                WHERE username = '$username' AND password = '$password'";

    $result = mysqli_query($conn,$query_sql);

    if (mysqli_num_rows($result) > 0){
        header("Location: index.php");
    }else{
        echo "<center><h1>Email atau Password Salah. Silahkan Coba Kembali</h1>
        <button><strong><a href='login.html'>Retry</a></strong></button></center>";
    }
    }
?>
