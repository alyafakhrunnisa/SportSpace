<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Akses ditolak! Hanya admin yang bisa mengelola data.'];
    header('Location: list.php');
    exit;
}

require __DIR__ . '/../includes/koneksi.php';

try {
    $pdo->query("TRUNCATE TABLE member RESTART IDENTITY");
    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Semua data member berhasil di-reset!'];
} catch (PDOException $e) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal mereset data: ' . $e->getMessage()];
}

header("Location: list.php");
exit;