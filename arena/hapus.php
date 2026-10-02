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
        // Hapus data dari tabel arena
        $stmt = $pdo->prepare("DELETE FROM arena WHERE id = :id");
        $stmt->execute(['id' => $id]);
        
        $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Data arena berhasil dihapus.'];
    } catch (PDOException $e) {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal menghapus data: ' . $e->getMessage()];
    }
} else {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'ID arena tidak ditemukan!'];
}

header('Location: list.php');
exit;
?>