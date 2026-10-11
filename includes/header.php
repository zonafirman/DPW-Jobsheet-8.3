<?php
session_start();
$__jobsheetRoot = str_replace('\\', '/', realpath(dirname(__DIR__)));
$__scriptDir = str_replace('\\', '/', realpath(dirname($_SERVER['SCRIPT_FILENAME'])) ?: dirname($_SERVER['SCRIPT_FILENAME']));
$__rel = ltrim(substr($__scriptDir, strlen($__jobsheetRoot)), '/');
$base = $__rel === '' ? '' : str_repeat('../', substr_count($__rel, '/') + 1);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMPUS-Mini - Jobsheet 8.3<?php echo isset($page_title) ? ' | ' . $page_title : ''; ?></title>
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS Custom -->
    <link rel="stylesheet" href="<?php echo $base; ?>assets/css/style.css">
</head>

<body>
    <header class="navbar navbar-expand-lg navbar-dark" style="background-color:#1d5b8a;">
        <div class="container">
            <a class="navbar-brand fw-semibold" href="<?php echo $base; ?>index.php">
                SIMPUS-Mini <span class="badge bg-light text-dark ms-1" style="font-size:0.75rem;">Jobsheet 8.3</span>
            </a>
            <button id="nav-toggle-btn" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
                aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <nav class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?php echo $base; ?>index.php">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $base; ?>buku/list.php">Buku</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $base; ?>buku/tambah.php">Tambah Buku</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $base; ?>anggota/list.php">Anggota</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $base; ?>anggota/tambah.php">Tambah Anggota</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $base; ?>sql/setup_db.php" target="_blank">Status DB</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <main class="container my-4">
