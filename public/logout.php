<?php
session_start();
session_destroy();

// Hapus cookie
setcookie("user_id", "", time() - 3600, "/");
setcookie("user_name", "", time() - 3600, "/");

header("Location: login.php");
exit();
?>
