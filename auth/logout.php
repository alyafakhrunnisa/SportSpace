<?php
session_start();
session_unset();
session_destroy(); // Menghapus semua data sesi login
header('Location: login.php');
exit;
?>