<?php
require '../config/google-config.php';
require '../config/db.php';

session_start();

// Cek apakah pengguna sudah login Google
if (!isset($_SESSION['google_token'])) {
    die("❌ Error: Silakan login ke Google terlebih dahulu.");
}

$client->setAccessToken($_SESSION['google_token']);
$calendarService = new Google\Service\Calendar($client);

// Validasi parameter ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("❌ Error: ID meeting tidak valid.");
}

$meeting_id = (int) $_GET['id'];

// Ambil data meeting dari database menggunakan prepared statement
$stmt = $conn->prepare("SELECT * FROM meetings WHERE id = ?");
$stmt->bind_param("i", $meeting_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("❌ Error: Meeting tidak ditemukan.");
}

$meeting = $result->fetch_assoc();

// Format waktu mulai dan selesai
$startTime = date('Y-m-d\TH:i:sP', strtotime($meeting['date_time']));
$endTime = date('Y-m-d\TH:i:sP', strtotime($meeting['date_time'] . ' +1 hour'));

$event = new Google\Service\Calendar\Event([
    'summary'     => $meeting['title'],
    'description' => $meeting['description'],
    'location'    => $meeting['location'],
    'start'       => [
        'dateTime' => $startTime,
        'timeZone' => 'Asia/Jakarta',
    ],
    'end'         => [
        'dateTime' => $endTime,
        'timeZone' => 'Asia/Jakarta',
    ],
]);

try {
    $calendarId = 'primary'; // Kalender utama
    $event = $calendarService->events->insert($calendarId, $event);
    echo "✅ Jadwal meeting berhasil dikirim ke Google Calendar: <a href='" . $event->htmlLink . "' target='_blank'>Lihat Acara</a>";
} catch (Exception $e) {
    echo "❌ Terjadi kesalahan saat mengirim ke Google Calendar: " . htmlspecialchars($e->getMessage());
}

$stmt->close();
$conn->close();
?>
