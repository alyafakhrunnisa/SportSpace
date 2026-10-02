<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Jika belum login, tendang ke halaman login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Logika deteksi jalur relatif otomatis
    $__root = dirname(__DIR__);
    $__script = dirname($_SERVER['SCRIPT_FILENAME']);
    $__rel = ltrim(str_replace('\\', '/', substr($__script, strlen($__root))), '/');
    $base = $__rel === '' ? '' : str_repeat('../', substr_count($__rel, '/') + 1);
    
    // Arahkan ke form login menggunakan base path
    header("Location: {$base}auth/login.php");
    exit;
}
?>