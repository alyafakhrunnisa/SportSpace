<?php
// Lapis 1: Pastikan user sudah login (auth.php sudah memuat session_start())
require __DIR__ . '/../includes/auth.php';

// Lapis 2: Pastikan user adalah admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Akses ditolak! Hanya admin yang bisa menambah data.'];
    header('Location: list.php');
    exit;
}

// Lapis 3: Baru panggil koneksi database jika lolos pengamanan
require __DIR__ . '/../includes/koneksi.php';

$id_member = trim($_POST['id_member'] ?? '');
$tipe = trim($_POST['tipe'] ?? '');
$nama = trim($_POST['nama'] ?? '');
$no_hp = trim($_POST['no_hp'] ?? '');
$email = trim($_POST['email'] ?? '');

$errors = [];
if ($id_member === '') { $errors[] = "ID Member wajib diisi."; }
if ($nama === '') { $errors[] = "Nama Lengkap wajib diisi."; }
if ($no_hp === '') { $errors[] = "No. HP wajib diisi."; }

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

$stmt = $pdo->prepare(
    "INSERT INTO member (id_member, tipe, nama, no_hp, email) 
     VALUES (:id_member, :tipe, :nama, :no_hp, :email)"
);

$stmt->execute([
    'id_member' => $id_member,
    'tipe' => $tipe,
    'nama' => $nama,
    'no_hp' => $no_hp,
    'email' => $email
]);

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Member baru berhasil diregistrasi secara permanen.'];
header('Location: list.php');
exit;