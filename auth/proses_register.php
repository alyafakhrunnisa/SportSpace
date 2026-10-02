<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}

$nama = trim($_POST['nama'] ?? '');
$username = trim($_POST['username'] ?? '');
$role = $_POST['role'] ?? 'petugas';
$password = $_POST['password'] ?? '';
$konfirmasi_password = $_POST['konfirmasi_password'] ?? '';

// Cek form kosong
if (empty($nama) || empty($username) || empty($password)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Semua kolom wajib diisi!'];
    header('Location: register.php');
    exit;
}

// Cek konfirmasi password
if ($password !== $konfirmasi_password) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Konfirmasi password tidak cocok!'];
    header('Location: register.php');
    exit;
}

try {
    // Cek apakah username sudah ada di database
    $stmt_cek = $pdo->prepare("SELECT id FROM users WHERE username = :username");
    $stmt_cek->execute(['username' => $username]);
    
    if ($stmt_cek->fetch()) {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Username sudah digunakan, silakan pilih yang lain!'];
        header('Location: register.php');
        exit;
    }

    // Hash password biar aman (Bcrypt)
    $password_hashed = password_hash($password, PASSWORD_BCRYPT);

    // Simpan ke database
    $stmt_insert = $pdo->prepare("INSERT INTO users (nama, username, password, role) VALUES (:nama, :username, :password, :role)");
    $stmt_insert->execute([
        'nama' => $nama,
        'username' => $username,
        'password' => $password_hashed,
        'role' => $role
    ]);
    
    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Akun berhasil dibuat! Silakan login.'];
    header('Location: login.php');
    exit;

} catch (PDOException $e) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Terjadi kesalahan sistem: ' . $e->getMessage()];
    header('Location: register.php');
    exit;
}
?>