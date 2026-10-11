# Wireframe & User Flow - SIMPUS-Mini

## Aktor
- **Tamu**: hanya bisa melihat katalog buku (Beranda, Daftar Buku) tanpa login.
- **Petugas**: login untuk mengakses seluruh fitur CRUD dan transaksi peminjaman.

## User Flow
### Peminjaman Buku
[Petugas Login] -> [Dashboard] -> [Pilih menu "Peminjaman Baru"]
-> [Pilih Anggota] -> [Pilih Buku (stok > 0)]
-> [Simpan] -> [Stok buku berkurang 1] -> [Kembali ke Dashboard]

### Pengembalian Buku
[Dashboard] -> [Menu "Pengembalian"] -> [Cari transaksi aktif (anggota/buku)]
-> [Tandai "Dikembalikan"] -> [Stok buku bertambah 1]
-> [Kembali ke Dashboard]

## Wireframe

### Halaman Login
```text
+--------------------------------------+
|             SIMPUS-Mini              |
|--------------------------------------|
|                                      |
|          [ Login Petugas ]           |
|                                      |
|  Username : [______________]         |
|  Password : [______________]         |
|                                      |
|             [   Masuk   ]            |
|                                      |
|   Belum punya akun? Daftar di sini   |
+--------------------------------------+
```

### Dashboard Petugas
```text
+-----------------------------------------------------+
| SIMPUS-Mini   Beranda | Buku | Anggota | Peminjaman | (Nama Petugas) Logout |
|-------------------------------------------------------|
|  [Total Buku]    [Total Anggota]    [Sedang Dipinjam] |
|                                                       |
|  Aksi Cepat:                                          |
|  [ + Peminjaman Baru ]    [ + Pengembalian ]          |
|                                                       |
|  Transaksi Terbaru                                    |
|  --------------------------------------------------   |
|  Anggota | Buku | Tgl Pinjam | Status                 |
+-----------------------------------------------------+
```

### Form Peminjaman
```text
+--------------------------------------+
| Form Peminjaman Buku                 |
|--------------------------------------|
| Anggota : [ dropdown pilih anggota ] |
| Buku    : [ dropdown, hanya stok>0 ] |
| Tanggal Pinjam : [ auto: hari ini ]  |
|                                      |
|        [ Simpan Peminjaman ]         |
+--------------------------------------+
```

### Form Pengembalian / Riwayat Peminjaman per Anggota
```text
+--------------------------------------+
| Riwayat Peminjaman — Siti Aminah     |
|--------------------------------------|
| Buku             | Pinjam  | Kembali | Status   |
| Laskar Pelangi   | 01/07   | 10/07   | Selesai  |
| Bumi Manusia     | 15/07   | -       | Dipinjam |
+--------------------------------------+
```

## Edge Case
- Buku stok habis tidak boleh dipilih di form Peminjaman.
- Anggota dengan tunggakan terlambat divalidasi di Jobsheet 12 (tugas mandiri).
