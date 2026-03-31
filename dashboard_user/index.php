<?php
session_start();
include '../database/dashboard.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>
    <link rel="stylesheet" href="dashboard_user/style.css">
    <link rel="shortcut icon" href="../asset/favicon.ico" type="image/x-icon">
    <link
        rel="stylesheet"
        type="text/css"
        href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css"
    />
    <link
        rel="stylesheet"
        type="text/css"
        href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/fill/style.css"
    />
</head>
<body>
    <header>
        <div class="logo-right">
            <img src="../asset/logo.png" alt="logo">
            <h3>Sistem Peminjaman Buku</h3>
            <h3>SMKS Sukapura</h3>
        </div>

        <div class="left">
            <h2>Selamat datang <?= isset($_SESSION['username']) ? ', ' . htmlspecialchars($_SESSION['username']) : '' ?>!</h2>
            <a href="../login_user" onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                <button>Log Out</button>
            </a>
        </div>
    </header>

    <aside>
        <a href="../dashboard_user">
            <i class="ph ph-book-open"></i><span>Dashboard</span>
        </a>
        <a href="../data_buku_user">
            <i class="ph ph-books"></i><span>Buku</span>
        </a>
        <a href="../peminjaman_user">
            <i class="ph ph-hand-arrow-down"></i><span>Peminjaman</span>
        </a>
        <a href="../pengembalian_user">
            <i class="ph ph-hand-arrow-up"></i><span>Pengembalian</span>
        </a>
    </aside>

        <div class="cover-books">
            <div class="cover-book">
                <img src="../asset/cover1.avif" alt="cover buku 1">
            </div>
            <div class="cover-book">
                <img src="../asset/cover1.avif" alt="cover buku 2">
            </div>
        </div>
    </main>
</body>
<script src="dashboard_user/script.js"></script>
</html>