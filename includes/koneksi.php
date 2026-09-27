<?php
$host     = getenv('PGHOST') ?: 'ep-tiny-mode-b3hvl1sj-pooler.c-4.ap-southeast-1.aws.neon.tech';
$port     = getenv('PGPORT') ?: '5432';
$dbname   = getenv('PGDATABASE') ?: 'neondb';
$user     = getenv('PGUSER') ?: 'neondb_owner';
$password = getenv('PGPASSWORD') ?: 'npg_V0nuRS4UiLQx';

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";
    
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
} catch (PDOException $e) {
    die("Koneksi Database Gagal: " . $e->getMessage());
}
?>