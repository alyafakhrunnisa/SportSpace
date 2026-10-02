<?php
session_start();
require __DIR__ . '/../includes/auth.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Akses ditolak! Hanya admin yang bisa mengelola data.'];
    header('Location: list.php');
    exit;
}

require __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

$id = $_POST['id'] ?? '';
$id_arena = $_POST['id_arena'] ?? '';
$nama = $_POST['nama'] ?? '';
$kategori = $_POST['kategori'] ?? '';
// Hapus format titik/Rp jika user iseng masukin pakai format string
$harga = str_replace(['Rp', '.', ' '], '', $_POST['harga']); 
$status = $_POST['status'] ?? '';

try {
    $stmt = $pdo->prepare("UPDATE arena SET id_arena = :id_arena, nama = :nama, kategori = :kategori, harga = :harga, status = :status WHERE id = :id");
    
    $stmt->execute([
        'id_arena' => $id_arena,
        'nama' => $nama,
        'kategori' => $kategori,
        'harga' => $harga,
        'status' => $status,
        'id' => $id
    ]);
    
    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Data arena berhasil diubah!'];
    header('Location: list.php');
    exit;

} catch (PDOException $e) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal mengubah data: ' . $e->getMessage()];
    header('Location: edit.php?id=' . $id);
    exit;
}
?>