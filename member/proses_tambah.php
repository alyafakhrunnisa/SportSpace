<?php
require_once __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama       = $_POST['nama'] ?? '';
    $email      = $_POST['email'] ?? '';
    $no_telepon = $_POST['no_telepon'] ?? '';

    try {
        $sql = "INSERT INTO member (nama, email, no_telepon) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nama, $email, $no_telepon]);

        header("Location: /member/list.php");
        exit;
    } catch (PDOException $e) {
        die("Gagal menyimpan data member: " . $e->getMessage());
    }
}
?>