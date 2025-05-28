<?php
session_start();
if (!isset($_SESSION['access_token'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Jadwal Meeting - E-Meeting</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #74ebd5, #9face6);
        }

        header {
            background: linear-gradient(to right, #4a00e0, #8e2de2);
            color: white;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        header h1 {
            margin: 0;
            font-size: 1.8rem;
        }

        main {
            background: white;
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            animation: fadeIn 0.7s ease-in-out;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }

        h2 {
            text-align: center;
            color: #444;
            margin-bottom: 20px;
        }

        form label {
            margin-top: 15px;
            display: block;
            font-weight: 600;
            color: #333;
        }

        form input[type="text"],
        form input[type="datetime-local"],
        form textarea {
            width: 100%;
            padding: 12px;
            margin-top: 6px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 1rem;
            transition: border 0.3s;
        }

        form input:focus,
        form textarea:focus {
            border-color: #4a00e0;
            outline: none;
            box-shadow: 0 0 5px rgba(138, 43, 226, 0.3);
        }

        form button {
            margin-top: 25px;
            width: 100%;
            padding: 12px;
            background-color: #4a00e0;
            color: white;
            font-size: 1rem;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s;
        }

        form button:hover {
            background-color: #3a00c5;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            font-weight: 500;
            color: #4a00e0;
            transition: color 0.3s;
        }

        .back-link i {
            margin-right: 6px;
        }

        .back-link:hover {
            color: #300096;
        }
    </style>
</head>
<body>

<header>
    <h1><i class="fas fa-calendar-plus"></i> Tambah Jadwal Meeting</h1>
</header>

<main>
    <h2>📅 Form Meeting</h2>
    <form action="process_meeting.php" method="POST">
        <label for="title">Judul Meeting:</label>
        <input type="text" name="title" id="title" required>

        <label for="description">Deskripsi:</label>
        <textarea name="description" id="description" rows="4" placeholder="Tulis keterangan atau agenda..."></textarea>

        <label for="date_time">Waktu Meeting:</label>
        <input type="datetime-local" name="date_time" id="date_time" required>

        <label for="location">Lokasi:</label>
        <input type="text" name="location" id="location" placeholder="Contoh: Zoom, Google Meet, Ruang A">

        <button type="submit"><i class="fas fa-save"></i> Simpan Jadwal</button>
    </form>

    <a href="dasboard.php" class="back-link"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard</a>
</main>

</body>
</html>
