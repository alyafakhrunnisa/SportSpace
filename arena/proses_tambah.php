<?php
// Lapis 1: Pastikan user sudah login
require __DIR__ . '/../includes/auth.php';

// Lapis 2: Pastikan user adalah admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Akses ditolak! Hanya admin yang bisa menambah data.'];
    header('Location: list.php');
    exit;
}

// Lapis 3: Baru panggil koneksi database setelah terbukti aman
require_once __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_arena     = $_POST['nama_arena'] ?? '';
    $jenis_olahraga = $_POST['jenis_olahraga'] ?? '';
    $harga_per_jam  = $_POST['harga_per_jam'] ?? 0;
    $status         = $_POST['status'] ?? 'Tersedia';

    try {
        $sql = "INSERT INTO arena (nama_arena, jenis_olahraga, harga_per_jam, status) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nama_arena, $jenis_olahraga, $harga_per_jam, $status]);

        // Tambahan flash message biar ada notif sukses di halaman list
        $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Arena baru berhasil ditambahkan.'];
        header("Location: list.php");
        exit;
    } catch (PDOException $e) {
        die("Gagal menyimpan data arena: " . $e->getMessage());
    }
}
?>