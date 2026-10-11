<?php
$page_title = "Daftar Anggota";
require __DIR__ . '/../includes/koneksi.php';
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$daftarAnggota = $pdo->query("SELECT * FROM anggota ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
        <section class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="card-title mb-3" style="color:#1d5b8a;">Daftar Anggota</h2>
                
                <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
                <?php endif; ?>

                <div class="mb-3">
                    <a href="tambah.php" class="btn text-white" style="background-color:#1d5b8a;">Tambah Anggota</a>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead style="background-color:#1d5b8a;">
                            <tr class="text-white">
                                <th>No. Anggota</th>
                                <th>Nama Lengkap</th>
                                <th>Alamat</th>
                                <th>No. HP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($daftarAnggota)): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-3">Belum ada data anggota. Silakan tambah lewat menu "Tambah Anggota".</td>
                            </tr>
                            <?php else: ?>
                            <?php foreach ($daftarAnggota as $anggota): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($anggota['no_anggota'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($anggota['nama'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($anggota['alamat'] ?? '-'); ?></td>
                                <td><?php echo htmlspecialchars($anggota['no_hp'] ?? '-'); ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning">Edit</button>
                                    <button type="button" class="btn btn-sm btn-danger btn-hapus">Hapus</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
