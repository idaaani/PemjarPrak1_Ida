<?php
$host = "localhost";        // Server database
$user = "root";             // Username default XAMPP
$password = "";             // Kosongkan password default
$dbname = "e_meeting";      // Nama database yang kamu buat

// Buat koneksi
$conn = new mysqli(hostname: $host, username: $user, password: $password, database: $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}
?>
