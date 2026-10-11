-- Jobsheet 10: skema tabel users (petugas / autentikasi)
-- Jalankan:
-- psql -h 127.0.0.1 -U postgres -d simpus_mini -f 02_users.sql

CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama VARCHAR(100) NOT NULL,
    role VARCHAR(20) NOT NULL DEFAULT 'petugas'
);
