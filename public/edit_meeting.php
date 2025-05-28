<?php
require '../config/db.php';

// Cek apakah ada ID yang dikirimkan
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data meeting berdasarkan ID
    $stmt = $conn->prepare("SELECT * FROM meetings WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $meeting = $result->fetch_assoc();

    if (!$meeting) {
        echo "Meeting tidak ditemukan!";
        exit;
    }
} else {
    echo "ID tidak ditemukan!";
    exit;
}

// Proses pembaruan data meeting
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date_time = $_POST['date_time'];
    $location = $_POST['location'];

    // Update data meeting di database
    $stmt = $conn->prepare("UPDATE meetings SET title = ?, description = ?, date_time = ?, location = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $title, $description, $date_time, $location, $id);

    if ($stmt->execute()) {
        echo "Jadwal Meeting berhasil diperbarui!";
        echo "<br><a href='list_meetings.php'>Kembali ke Daftar Meeting</a>";
        exit;
    } else {
        echo "Gagal memperbarui jadwal meeting.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jadwal Meeting</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 60%;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #0077cc;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #005fa3;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Edit Jadwal Meeting</h2>

        <form action="edit_meeting.php?id=<?php echo urlencode($id); ?>" method="POST">
            <label>Judul Meeting:</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($meeting['title']); ?>" required>

            <label>Deskripsi:</label>
            <textarea name="description"><?php echo htmlspecialchars($meeting['description']); ?></textarea>

            <label>Waktu Meeting:</label>
            <input type="datetime-local" name="date_time" value="<?php echo date('Y-m-d\TH:i', strtotime($meeting['date_time'])); ?>" required>

            <label>Lokasi:</label>
            <input type="text" name="location" value="<?php echo htmlspecialchars($meeting['location']); ?>">

            <button type="submit">Simpan Perubahan</button>
        </form>
    </div>

</body>
</html>

<?php
$conn->close();
?>
