<?php
session_start();
require __DIR__ . '/../config/google-config.php';
require __DIR__ . '/../config/db.php';

if (!isset($_SESSION['access_token'])) {
    die('Harap login dengan Google!');
}

$client->setAccessToken($_SESSION['access_token']);
$calendarService = new Google\Service\Calendar($client);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $eventSummary = $_POST['summary'];
    $eventLocation = $_POST['location'] ?: 'Tidak ada lokasi';

    $eventStartRaw = $_POST['start_time'];
    $eventEndRaw = $_POST['end_time'];

    // Format waktu ke ISO 8601
    $eventStart = $eventStartRaw . ':00+07:00';
    $eventEnd = $eventEndRaw . ':00+07:00';

    $event = new Google\Service\Calendar\Event([
        'summary' => $eventSummary,
        'start' => ['dateTime' => $eventStart, 'timeZone' => 'Asia/Jakarta'],
        'end' => ['dateTime' => $eventEnd, 'timeZone' => 'Asia/Jakarta'],
        'location' => $eventLocation,
    ]);

    try {
        $calendarId = 'primary';
        $event = $calendarService->events->insert($calendarId, $event);

        // Simpan ke database
        $stmt = $conn->prepare("INSERT INTO meeting_history (summary, start_time, end_time, location) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $eventSummary, $eventStartRaw, $eventEndRaw, $eventLocation);
        $stmt->execute();
        $stmt->close();

        echo "<p>✅ Acara berhasil ditambahkan: <a href='" . $event->htmlLink . "' target='_blank'>Lihat di Google Calendar</a></p>";
    } catch (Exception $e) {
        echo "<p style='color:red;'>❌ Gagal menambahkan acara: " . $e->getMessage() . "</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Acara - E-Meeting</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background: linear-gradient(to right, #6dd5ed, #2193b0);
            color: #333;
        }

        header {
            background-color: #1e3c72;
            background-image: linear-gradient(to right, #2a5298, #1e3c72);
            color: white;
            text-align: center;
            padding: 2rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        header h1 {
            margin: 0;
            font-size: 2rem;
        }

        main {
            background-color: #ffffff;
            margin: 30px auto;
            padding: 30px;
            border-radius: 12px;
            max-width: 700px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 600;
            display: block;
            margin-bottom: 8px;
        }

        .form-group input, 
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .form-group input:focus, 
        .form-group textarea:focus {
            outline: none;
            border-color: #1e90ff;
            box-shadow: 0 0 5px rgba(30, 144, 255, 0.4);
        }

        .form-group button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(to right, #00b09b, #96c93d);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .form-group button:hover {
            transform: scale(1.02);
            background: linear-gradient(to right, #009688, #8bc34a);
        }

        .form-group a.button-link {
            display: inline-block;
            text-align: center;
            padding: 12px;
            margin-top: 10px;
            background: #f44336;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        .form-group a.button-link:hover {
            background: #d32f2f;
        }

        .note {
            text-align: center;
            font-size: 0.9rem;
            margin-top: 20px;
            color: #666;
        }

        .icon {
            margin-right: 8px;
            color: #2196f3;
        }

        @media (max-width: 600px) {
            main {
                padding: 20px;
                margin: 20px;
            }

            header h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>

<header>
    <h1><i class="fa-solid fa-calendar-plus"></i> Tambah Acara Baru ke Google Calendar</h1>
</header>

<main>
    <h2>📅 Formulir Penjadwalan Meeting</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="summary"><i class="fa-solid fa-pen-to-square icon"></i>Nama Acara</label>
            <input type="text" id="summary" name="summary" placeholder="Contoh: Rapat Tim Bulanan" required>
        </div>
        <div class="form-group">
            <label for="start_time"><i class="fa-solid fa-hourglass-start icon"></i>Waktu Mulai</label>
            <input type="datetime-local" id="start_time" name="start_time" required>
        </div>
        <div class="form-group">
            <label for="end_time"><i class="fa-solid fa-hourglass-end icon"></i>Waktu Selesai</label>
            <input type="datetime-local" id="end_time" name="end_time" required>
        </div>
        <div class="form-group">
            <label for="location"><i class="fa-solid fa-location-dot icon"></i>Lokasi (Opsional)</label>
            <input type="text" id="location" name="location" placeholder="Zoom, Google Meet, Ruang 305, dll.">
        </div>
        <div class="form-group">
            <button type="submit"><i class="fa-solid fa-circle-check"></i> Tambah Acara</button>
        </div>
        <div class="form-group">
            <a href="dasboard.php" class="button-link"><i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard</a>
        </div>
    </form>
    <p class="note">✅ Setelah berhasil ditambahkan, Anda dapat membuka acara langsung di Google Calendar.</p>
</main>

</body>
</html>

