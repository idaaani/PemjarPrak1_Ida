<?php
require 'google-config.php';
session_start();

// Cek apakah pengguna sudah login Google
if (!isset($_SESSION['google_token'])) {
    die("❌ Silakan login ke Google terlebih dahulu.");
}

$client->setAccessToken($_SESSION['google_token']);
$calendarService = new Google\Service\Calendar($client);

// Ambil daftar acara dari kalender utama
try {
    $events = $calendarService->events->listEvents('primary');
    $items = $events->getItems();

    echo "<h2>📅 Jadwal Meeting di Google Calendar</h2>";

    if (empty($items)) {
        echo "<p>Tidak ada acara yang ditemukan.</p>";
    } else {
        foreach ($items as $event) {
            $summary = $event->getSummary() ?: '(Tanpa Judul)';
            $start = $event->getStart()->getDateTime() ?: $event->getStart()->getDate();
            echo "<p><strong>" . htmlspecialchars($summary) . "</strong> - " . htmlspecialchars($start) . "</p>";
        }
    }

} catch (Exception $e) {
    echo "<p>❌ Terjadi kesalahan saat mengambil data: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
