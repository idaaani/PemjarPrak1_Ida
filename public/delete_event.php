<?php
session_start();
require __DIR__ . '/../config/google-config.php';

if (!isset($_SESSION['access_token'])) {
    die('Harap login dengan Google!');
}

$client->setAccessToken($_SESSION['access_token']);
$calendarService = new Google\Service\Calendar($client);

if (isset($_GET['id'])) {
    $eventId = $_GET['id']; // ID event dari URL
    $calendarId = 'primary';

    try {
        $calendarService->events->delete($calendarId, $eventId);
        echo "<script>alert('Acara berhasil dihapus.'); window.location.href='events.php';</script>";
    } catch (Exception $e) {
        echo 'Gagal menghapus acara: ' . $e->getMessage();
    }
} else {
    echo "ID acara tidak ditemukan.";
}
?>
