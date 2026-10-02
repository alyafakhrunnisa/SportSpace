<?php
$host = "db.ebujrsdqfgskabhhjlcw.supabase.co";
$port = "5432";
$dbname = "postgres";
$user = "postgres";
$password = "29Januari200"; 

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Koneksi gagal : " . $e->getMessage());
}
?>