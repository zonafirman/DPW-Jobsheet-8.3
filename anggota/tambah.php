<?php
$page_title = "Tambah Anggota";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
        <section class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="card-title mb-3" style="color:#1d5b8a;">Tambah Anggota</h2>
                <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
                <?php endif; ?>
                <form id="form-tambah" method="post" action="proses_tambah.php">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">No. Anggota</label>
                        <input type="text" name="no_anggota" class="form-control" placeholder="Contoh: A001" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat</label>
                        <input type="text" name="alamat" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">No. HP</label>
                        <input type="text" name="no_hp" class="form-control">
                    </div>
                    <button type="submit" class="btn text-white" style="background-color:#1d5b8a;">Simpan</button>
                    <a href="list.php" class="btn btn-secondary ms-2">Batal</a>
                </form>
            </div>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
