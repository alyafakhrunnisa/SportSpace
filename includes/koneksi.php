<?php
// Konfigurasi Database Neon PostgreSQL
$host   = 'ep-tiny-mode-b3hvl1sj-pooler.c-4.ap-southeast-1.aws.neon.tech';
$db     = 'neondb';
$user   = 'neondb_owner';
$pass   = 'npg_V0nuRS4UiLQx';

// DSN untuk PostgreSQL (wajib sslmode=require untuk Neon)
$dsn = "pgsql:host=$host;port=5432;dbname=$db;sslmode=require";

try {
    // Membuat koneksi PDO
    $pdo = new PDO($dsn, $user, $pass);
    
    // Set mode error agar exception muncul kalau ada masalah query
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    // Tampilkan pesan error kalau koneksi gagal
    die("Koneksi gagal: " . $e->getMessage());
}
?>