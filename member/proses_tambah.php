<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

// Cek apakah form benar-benar disubmit
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: tambah.php');
    exit;
}

// Ambil data dari form
$nama = trim($_POST['nama'] ?? '');
$no_telp = trim($_POST['no_telp'] ?? '');

try {
    // Masukkan data ke tabel member
    $stmt = $pdo->prepare(
        "INSERT INTO member (nama, no_telp) 
         VALUES (:nama, :no_telp)"
    );

    $stmt->execute([
        'nama'    => $nama,
        'no_telp' => $no_telp
    ]);

    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Data member baru berhasil ditambahkan!'];
} catch (PDOException $e) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal menyimpan data member: ' . $e->getMessage()];
}

header('Location: list.php');
exit;