<?php
require 'koneksi.php';

// Ambil data dari form
$name = $_POST['name'];
$testimonial = $_POST['testimony'];
$date = date('H:i, d F Y'); // Format waktu sesuai kebutuhan

// Masukkan data ke dalam tabel testimonials
$sql = "INSERT INTO testimonials (name, date, description) VALUES (:name, :date, :description)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':name', $name, PDO::PARAM_STR);
$stmt->bindParam(':date', $date, PDO::PARAM_STR);
$stmt->bindParam(':description', $testimonial, PDO::PARAM_STR);

try {
    $stmt->execute();
    $response = "Testimonial berhasil disimpan!";
} catch (PDOException $e) {
    $response = "Error: " . $e->getMessage();
}

// Tutup koneksi database
$conn = null;

// Mengirimkan response ke halaman utama (index.php) menggunakan JavaScript
echo "<script>alert('$response'); window.location.href='/UasWeb/WildTaste/LandingPage/index.php#Testi';</script>";
?>
