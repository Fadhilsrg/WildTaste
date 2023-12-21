<?php
require 'koneksi.php';

// Ambil data dari form
$name = $_POST['name'];
$testimonial = $_POST['testimony'];
$date = date('H:i, d F Y'); // Format waktu sesuai kebutuhan

// Cek kata-kata kasar
$blacklist = array("fuck", "anjing", "babi", "pepek");
$containsProfanity = false;

foreach ($blacklist as $word) {
    if (stripos($testimonial, $word) !== false) {
        $containsProfanity = true;
        break;
    }
}

// Jika testimoni mengandung kata-kata kasar, hapus dari database
if ($containsProfanity) {
    $sqlDelete = "DELETE FROM testimonials WHERE name = :name AND description = :description";
    $stmtDelete = $conn->prepare($sqlDelete);
    $stmtDelete->bindParam(':name', $name, PDO::PARAM_STR);
    $stmtDelete->bindParam(':description', $testimonial, PDO::PARAM_STR);
    
    try {
        $stmtDelete->execute();
        $response = "Testimonial mengandung kata-kata kasar dan telah dihapus!";
    } catch (PDOException $e) {
        $response = "Error saat menghapus: " . $e->getMessage();
    }
} else {
    // Masukkan data ke dalam tabel testimonials
    $sqlInsert = "INSERT INTO testimonials (name, date, description) VALUES (:name, :date, :description)";
    $stmtInsert = $conn->prepare($sqlInsert);
    $stmtInsert->bindParam(':name', $name, PDO::PARAM_STR);
    $stmtInsert->bindParam(':date', $date, PDO::PARAM_STR);
    $stmtInsert->bindParam(':description', $testimonial, PDO::PARAM_STR);

    try {
        $stmtInsert->execute();
        $response = "Testimonial berhasil disimpan!";
    } catch (PDOException $e) {
        $response = "Error saat menyimpan: " . $e->getMessage();
    }
}

// Tutup koneksi database
$conn = null;

// Mengirimkan response ke halaman utama (index.php) menggunakan JavaScript
echo "<script>alert('$response'); window.location.href='/WildTaste/LandingPage/index.php#Testi';</script>";
?>
