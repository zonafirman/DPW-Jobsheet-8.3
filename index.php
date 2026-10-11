<?php
$page_title = "Beranda";
require __DIR__ . '/includes/koneksi.php';

$totalBuku = $pdo->query("SELECT COUNT(*) FROM buku")->fetchColumn();
$totalAnggota = $pdo->query("SELECT COUNT(*) FROM anggota")->fetchColumn();

// Cek apakah tabel peminjaman ada untuk menghitung yang sedang dipinjam
$sedangDipinjam = 0;
try {
    $sedangDipinjam = $pdo->query("SELECT COUNT(*) FROM peminjaman WHERE status = 'dipinjam'")->fetchColumn();
} catch (Exception $e) {
    $sedangDipinjam = 0;
}

include __DIR__ . '/includes/header.php';
?>
        <section class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="card-title mb-0" style="color:#1d5b8a;">Ringkasan Sistem</h2>
                    <span class="badge bg-success">Status Basis Data: Terhubung</span>
                </div>
                <p class="text-muted">Aplikasi SIMPUS-Mini Jobsheet 8.3 terhubung langsung dengan basis data relasional PostgreSQL <code>simpus_mini</code>.</p>
                <div class="row g-3 text-center">
                    <div class="col-12 col-md-4">
                        <div class="p-3 rounded-3" style="background-color:#eef4fa;">
                            <h3 class="h6 text-secondary">Total Buku</h3>
                            <p class="fs-2 fw-bold mb-0" style="color:#1d5b8a;"><?php echo (int) $totalBuku; ?></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="p-3 rounded-3" style="background-color:#eef4fa;">
                            <h3 class="h6 text-secondary">Total Anggota</h3>
                            <p class="fs-2 fw-bold mb-0" style="color:#1d5b8a;"><?php echo (int) $totalAnggota; ?></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="p-3 rounded-3" style="background-color:#eef4fa;">
                            <h3 class="h6 text-secondary">Sedang Dipinjam</h3>
                            <p class="fs-2 fw-bold mb-0" style="color:#1d5b8a;"><?php echo (int) $sedangDipinjam; ?></p>
                        </div>
                    </div>
                </div>
                
                <hr class="my-4">
                <h4 class="h6 fw-semibold text-secondary mb-3">Verifikasi Skema Basis Data Jobsheet 8.3:</h4>
                <div class="d-flex flex-wrap gap-2">
                    <span class="badge bg-primary p-2">Tabel: anggota</span>
                    <span class="badge bg-primary p-2">Tabel: buku</span>
                    <span class="badge bg-primary p-2">Tabel: peminjaman</span>
                    <span class="badge bg-primary p-2">Tabel: users</span>
                    <a href="sql/setup_db.php" target="_blank" class="btn btn-sm btn-outline-primary ms-auto">Cek Detail Skema (setup_db.php)</a>
                </div>
            </div>
        </section>
<?php include __DIR__ . '/includes/footer.php'; ?>
