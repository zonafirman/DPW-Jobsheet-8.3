<?php
// Konfigurasi Koneksi Basis Data PostgreSQL (Jobsheet 8.3)
$host = getenv('DB_HOST') ?: "localhost";
$port = getenv('DB_PORT') ?: "5432";
$db   = getenv('DB_NAME') ?: "simpus_mini";
$user = getenv('DB_USER') ?: "postgres";
$pass = getenv('DB_PASS') ?: "yonafirman20042006stsd";

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Fallback otomatis jika diuji pada Laragon dengan default password 'postgres'
    try {
        $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, "postgres");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e2) {
        die("Koneksi database gagal: " . $e->getMessage());
    }
}
