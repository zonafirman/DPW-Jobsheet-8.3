-- Jobsheet 12: skema tabel peminjaman
-- Jalankan:
-- psql -h 127.0.0.1 -U postgres -d simpus_mini -f 03_peminjaman.sql

CREATE TABLE IF NOT EXISTS peminjaman (
    id SERIAL PRIMARY KEY,
    id_buku INTEGER NOT NULL REFERENCES buku(id) ON DELETE CASCADE,
    id_anggota INTEGER NOT NULL REFERENCES anggota(id) ON DELETE CASCADE,
    tanggal_pinjam DATE NOT NULL DEFAULT CURRENT_DATE,
    tanggal_kembali DATE,
    status VARCHAR(20) NOT NULL DEFAULT 'dipinjam'
);
