<?php
require '../config/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // pastikan ID berupa integer

    // Siapkan dan eksekusi query
    $stmt = $conn->prepare("DELETE FROM meetings WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirect ke halaman daftar setelah penghapusan
        header("Location: list_meetings.php?status=deleted");
        exit();
    } else {
        echo "Gagal menghapus jadwal: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID tidak ditemukan.";
}

$conn->close();
?>
