<?php
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $date_time = trim($_POST['date_time']);
    $location = trim($_POST['location']);

    // Siapkan dan jalankan statement SQL
    $stmt = $conn->prepare("INSERT INTO meetings (title, description, date_time, location) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $description, $date_time, $location);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>✅ Jadwal Meeting berhasil disimpan!</p>";
    } else {
        echo "<p style='color: red;'>❌ Gagal menyimpan jadwal. Silakan coba lagi.</p>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<p style='color: red;'>Akses tidak valid!</p>";
}
?>
