<?php
session_start();
require __DIR__ . '/../config/google-config.php';

if (!isset($_SESSION['access_token'])) {
    die('Harap login dengan Google!');
}

$client->setAccessToken($_SESSION['access_token']);
$calendarService = new Google\Service\Calendar($client);
$calendarId = 'primary';
$events = $calendarService->events->listEvents($calendarId);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Acara - E-Meeting</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Roboto&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background: linear-gradient(to right, #74ebd5, #9face6);
      color: #333;
    }

    header {
      background: #4a00e0;
      background: linear-gradient(to right, #8e2de2, #4a00e0);
      color: white;
      padding: 20px;
      text-align: center;
      border-bottom: 4px solid #fff;
    }

    main {
      max-width: 1000px;
      margin: 40px auto;
      background: white;
      border-radius: 15px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
      padding: 30px;
      animation: fadeIn 0.6s ease-in;
    }

    h1, h2 {
      margin-top: 0;
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #4a00e0;
    }

    .event-item {
      background: #f0f4ff;
      padding: 20px;
      margin-bottom: 20px;
      border-left: 6px solid #4a00e0;
      border-radius: 10px;
      position: relative;
      transition: all 0.3s ease;
    }

    .event-item:hover {
      transform: translateY(-3px);
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .event-summary {
      font-size: 1.3rem;
      font-weight: bold;
      color: #333;
      margin-bottom: 10px;
    }

    .event-time, .event-details {
      font-size: 0.95rem;
      margin-bottom: 5px;
    }

    .no-events {
      text-align: center;
      font-size: 1.2rem;
      color: #555;
    }

    .delete-btn {
      position: absolute;
      top: 20px;
      right: 20px;
      background-color: #ff4d4f;
      border: none;
      color: white;
      padding: 8px 12px;
      border-radius: 6px;
      font-size: 0.85rem;
      cursor: pointer;
      transition: background 0.3s;
    }

    .delete-btn:hover {
      background-color: #d9363e;
    }

    .btn-group {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-top: 40px;
    }

    .back-btn {
      background-color: #4a00e0;
      color: white;
      padding: 12px 24px;
      border: none;
      border-radius: 10px;
      font-size: 1rem;
      text-decoration: none;
      transition: background 0.3s;
    }

    .back-btn:hover {
      background-color: #3600b3;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(15px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

<header>
  <h1>📅 E-Meeting - Daftar Acara</h1>
</header>

<main>
  <h2>Jadwal Terdekat Anda</h2>

  <?php if (count($events->getItems()) > 0): ?>
    <?php foreach ($events->getItems() as $event): ?>
      <div class="event-item">
        <div class="event-summary">
          <?php echo htmlspecialchars($event->getSummary()); ?>
        </div>
        <div class="event-time">
          <?php 
            $start = $event->getStart()->getDateTime();
            echo '🕒 Mulai: ' . ($start ? date("d-m-Y H:i", strtotime($start)) : 'Tidak tersedia');
          ?>
        </div>
        <div class="event-details">
          <?php echo '📍 Lokasi: ' . ($event->getLocation() ?: 'Tidak ada lokasi'); ?>
        </div>
        <a class="delete-btn" href="delete_event.php?id=<?php echo $event->getId(); ?>"
           onclick="return confirm('Yakin ingin menghapus acara ini?')">
          Hapus
        </a>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p class="no-events">🙁 Tidak ada acara yang dijadwalkan.</p>
  <?php endif; ?>

  <div class="btn-group">
    <a href="dasboard.php" class="back-btn">🏠 Kembali ke Dashboard</a>
    <a href="add_event.php" class="back-btn" style="background-color:#28a745;">➕ Tambah Event</a>
  </div>
</main>

</body>
</html>
