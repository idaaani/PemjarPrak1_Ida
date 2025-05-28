<?php
session_start();
require __DIR__ . '/config/google-config.php';

if (!isset($_GET['code'])) {
    die('Kode tidak ditemukan');
}

$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
$_SESSION['access_token'] = $token;

header("Location: /emeeting/public/dasboard.php");
exit();
?>
