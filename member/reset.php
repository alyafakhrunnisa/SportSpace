<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

try {
    // Pake TRUNCATE biar bersih sampai ke akar dan ID balik ke 1
    $pdo->query("TRUNCATE TABLE member RESTART IDENTITY");
    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Semua data member berhasil di-reset!'];
} catch (PDOException $e) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal mereset data: ' . $e->getMessage()];
}

header("Location: list.php");
exit;