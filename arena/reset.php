<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

try {
    // Ganti nama tabelnya jadi member
    $pdo->query("TRUNCATE TABLE member RESTART IDENTITY");
    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Semua data member berhasil di-reset!'];
} catch (PDOException $e) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal mereset data: ' . $e->getMessage()];
}

header("Location: list.php");
exit;