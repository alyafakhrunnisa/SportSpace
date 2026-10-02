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

// Tangkap semua data dari form
$id = $_POST['id'] ?? '';
$id_member = $_POST['id_member'] ?? '';
$tipe = $_POST['tipe'] ?? '';
$nama = $_POST['nama'] ?? '';
$no_hp = $_POST['no_hp'] ?? '';
$email = $_POST['email'] ?? '';
$tanggal_bergabung = $_POST['tanggal_bergabung'] ?? '';

try {
    // Perintah UPDATE ke database PostgreSQL
    $stmt = $pdo->prepare("UPDATE member SET id_member = :id_member, tipe = :tipe, nama = :nama, no_hp = :no_hp, email = :email, tanggal_bergabung = :tanggal_bergabung WHERE id = :id");
    
    $stmt->execute([
        'id_member' => $id_member,
        'tipe' => $tipe,
        'nama' => $nama,
        'no_hp' => $no_hp,
        'email' => $email,
        'tanggal_bergabung' => $tanggal_bergabung,
        'id' => $id
    ]);
    
    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Data member berhasil diubah!'];
    header('Location: list.php');
    exit;

} catch (PDOException $e) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal mengubah data: ' . $e->getMessage()];
    header('Location: edit.php?id=' . $id);
    exit;
}
?>