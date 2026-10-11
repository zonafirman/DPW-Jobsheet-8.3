<?php
// Script eksekusi dan verifikasi skema database Jobsheet 8.3
require __DIR__ . '/../includes/koneksi.php';

header('Content-Type: text/plain; charset=utf-8');

echo "=== INISIALISASI & SETUP DATABASE SIMPUS-MINI (JOBSHEET 8.3) ===\n\n";

$files = [
    '01_buku_anggota.sql' => 'Tabel buku & anggota (Jobsheet 8)',
    '02_users.sql'        => 'Tabel users (petugas/auth - Jobsheet 10)',
    '03_peminjaman.sql'   => 'Tabel peminjaman (Jobsheet 12)',
];

foreach ($files as $file => $deskripsi) {
    $fullPath = __DIR__ . '/' . $file;
    if (file_exists($fullPath)) {
        $sql = file_get_contents($fullPath);
        try {
            $pdo->exec($sql);
            echo "[OK] Sukses mengeksekusi $file ($deskripsi)\n";
        } catch (PDOException $e) {
            echo "[ERROR] Gagal mengeksekusi $file: " . $e->getMessage() . "\n";
        }
    } else {
        echo "[NOT FOUND] File $file tidak ditemukan!\n";
    }
}

echo "\n--- VERIFIKASI TABEL PADA BASIS DATA simpus_mini ---\n";
try {
    $tables = $pdo->query("SELECT table_name FROM information_schema.tables WHERE table_schema='public' ORDER BY table_name")->fetchAll(PDO::FETCH_COLUMN);
    echo "Jumlah tabel ditemukan: " . count($tables) . "\n";
    foreach ($tables as $i => $tbl) {
        $count = $pdo->query("SELECT COUNT(*) FROM $tbl")->fetchColumn();
        echo ($i + 1) . ". $tbl ($count baris data)\n";
    }
    
    $required = ['anggota', 'buku', 'peminjaman', 'users'];
    $diff = array_diff($required, $tables);
    if (empty($diff)) {
        echo "\n[STATUS: LENGKAP & VALID] Seluruh 4 tabel simpus_mini berhasil diverifikasi!\n";
    } else {
        echo "\n[STATUS: PERINGATAN] Tabel berikut belum ada: " . implode(', ', $diff) . "\n";
    }
} catch (PDOException $e) {
    echo "Gagal memverifikasi tabel: " . $e->getMessage() . "\n";
}
