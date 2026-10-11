@echo off
setlocal enabledelayedexpansion

:: Cek izin Administrator, jika belum maka minta izin (UAC)
net session >nul 2>&1
if %errorLevel% neq 0 (
    echo Meminta akses Administrator...
    powershell -Command "Start-Process cmd -ArgumentList '/c `"%~f0`"' -Verb RunAs"
    exit /b
)

title Setup Database PostgreSQL SIMPUS-Mini - Jobsheet 8.3
echo ====================================================================
echo     SETUP DATABASE POSTGRESQL (SIMPUS-MINI) - JOBSHEET 8.3
echo ====================================================================
echo.

set "HBA=C:\Program Files\PostgreSQL8\data\pg_hba.conf"
set "HBA_BAK=C:\Program Files\PostgreSQL8\data\pg_hba.conf.bak"
set "PSQL=C:\Program Files\PostgreSQL8in\psql.exe"

echo 1. Menyiapkan database simpus_mini...
"%PSQL%" -U postgres -h 127.0.0.1 -p 5432 -c "CREATE DATABASE simpus_mini;" 2>nul

echo 2. Menjalankan skema tabel kumulatif Jobsheet 8.3:
echo    - 01_buku_anggota.sql (buku, anggota)
"%PSQL%" -U postgres -h 127.0.0.1 -p 5432 -d simpus_mini -f "%~dp0sql_buku_anggota.sql"

echo    - 02_users.sql (users)
"%PSQL%" -U postgres -h 127.0.0.1 -p 5432 -d simpus_mini -f "%~dp0sql_users.sql"

echo    - 03_peminjaman.sql (peminjaman)
"%PSQL%" -U postgres -h 127.0.0.1 -p 5432 -d simpus_mini -f "%~dp0sql_peminjaman.sql"

echo.
echo 3. Langkah 4: Verifikasi tabel (\dt):
"%PSQL%" -U postgres -h 127.0.0.1 -p 5432 -d simpus_mini -c "\dt"

echo.
echo ====================================================================
echo   BERHASIL! Skema database Jobsheet 8.3 telah aktif sepenuhnya!
echo ====================================================================
echo.
pause
