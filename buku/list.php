<?php
$page_title = "Daftar Buku";
require __DIR__ . '/../includes/koneksi.php';
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$daftarBuku = $pdo->query("SELECT * FROM buku ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
        <section class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="card-title mb-3" style="color:#1d5b8a;">Daftar Buku</h2>
                
                <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
                <?php endif; ?>

                <div class="mb-3">
                    <a href="tambah.php" class="btn text-white" style="background-color:#1d5b8a;">Tambah Buku</a>
                </div>
                <div class="search-box mb-3">
                    <label for="search-input">Cari Judul Buku</label>
                    <input type="text" id="search-input" class="form-control" placeholder="Ketik judul buku...">
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead style="background-color:#1d5b8a;">
                            <tr class="text-white">
                                <th>Judul</th>
                                <th>Pengarang</th>
                                <th>Tahun</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($daftarBuku)): ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted py-3">Belum ada data buku. Silakan tambah lewat menu "Tambah Buku".</td>
                            </tr>
                            <?php else: ?>
                            <?php foreach ($daftarBuku as $buku): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($buku['judul'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($buku['pengarang'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($buku['tahun'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($buku['kategori'] ?? '-'); ?></td>
                                <td><?php echo htmlspecialchars($buku['stok'] ?? '0'); ?></td>
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
