<?php
session_start();
require __DIR__ . '/../includes/auth.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Akses ditolak! Hanya admin yang bisa mengelola data.'];
    header('Location: list.php');
    exit;
}

require __DIR__ . '/../includes/koneksi.php';
$id = $_GET['id'] ?? null;

if ($id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM member WHERE id = :id");
        $stmt->execute(['id' => $id]);
        
        // Buat notif sukses estetik
        $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Data member berhasil dihapus.'];
    } catch (PDOException $e) {
        // Buat notif error kalau gagal
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal menghapus data: ' . $e->getMessage()];
    }
} else {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'ID member tidak ditemukan!'];
}

// Kembalikan ke halaman daftar
header('Location: list.php');
exit;
?>