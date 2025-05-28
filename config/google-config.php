<?php
require __DIR__ . '/../vendor/autoload.php';
$client = new Google_Client();
$client->setAuthConfig(__DIR__ . '/credentials.json');
$client->setRedirectUri('http://localhost/emeeting/google-callback.php');
$client->addScope(Google\Service\Calendar::CALENDAR);
?>