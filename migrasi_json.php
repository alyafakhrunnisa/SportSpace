<?php
// Panggil koneksi
require __DIR__ . '/includes/koneksi.php';

$jsonFile = __DIR__ . '/arena.json';

// Cek filenya ada atau nggak
if (!file_exists($jsonFile)) {
    die("Wah, file arena.json nggak ketemu nih!");
}

// Baca isi JSON dan ubah jadi Array PHP
$jsonData = file_get_contents($jsonFile);
$dataArena = json_decode($jsonData, true);

$jumlahSukses = 0;

$stmt = $pdo->prepare("INSERT INTO arena (id_arena, nama, kategori, harga, status) VALUES (:id_arena, :nama, :kategori, :harga, :status)");

foreach ($dataArena as $arena) {
    try {
        $stmt->execute([
            'id_arena' => $arena['id_arena'],
            'nama'     => $arena['nama'],
            'kategori' => $arena['kategori'],
            'harga'    => $arena['harga'],
            'status'   => $arena['status']
        ]);
        $jumlahSukses++;
    } catch (PDOException $e) {
        continue;
    }
}

echo "<h3>Migrasi Berhasil! 🎉</h3>";
echo "<p>Sebanyak <strong>$jumlahSukses</strong> data arena dari file JSON sukses dipindahkan ke database PostgreSQL SportSpace.</p>";
echo "<a href='arena/list.php'>Lihat Daftar Arena →</a>";
?>