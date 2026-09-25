<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: tambah.php');
    exit;
}

// Sesuaikan dengan name di input form lu
$id_arena = trim($_POST['id_arena'] ?? '');
$nama = trim($_POST['nama'] ?? '');
$kategori = trim($_POST['kategori'] ?? '');
$harga = trim($_POST['harga'] ?? 0);
$status = trim($_POST['status'] ?? 'Tersedia');

try {
    $stmt = $pdo->prepare("INSERT INTO arena (id_arena, nama, kategori, harga, status) VALUES (:id_arena, :nama, :kategori, :harga, :status)");
    $stmt->execute([
        'id_arena' => $id_arena,
        'nama'     => $nama,
        'kategori' => $kategori,
        'harga'    => $harga,
        'status'   => $status
    ]);
    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Arena baru berhasil ditambahkan!'];
} catch (PDOException $e) {
    if ($e->getCode() == '23505') {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'ID Arena sudah terdaftar!'];
    } else {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal menyimpan data: ' . $e->getMessage()];
    }
}

header('Location: list.php');
exit;