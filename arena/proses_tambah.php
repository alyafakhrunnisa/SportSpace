<?php
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

        header("Location: /arena/list.php");
        exit;
    } catch (PDOException $e) {
        die("Gagal menyimpan data arena: " . $e->getMessage());
    }
}
?>