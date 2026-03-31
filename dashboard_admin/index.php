<?php
include '../database/dashboard.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="dashboard_admin/style.css">
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
            <h3>Sistem Peminjaman Buku
            <br><span>SMKS Sukapura</span></h3>
        </div>

        <div class="left">
            <h2>selamat datang admin!!</h2>
            <a href="../login_admin" onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                <button>Log Out</button>
            </a>
        </div>
    </header>

    <aside>
        <a href="../dashboard_admin">
            <i class="ph ph-book-open"></i><span>Dashboard</span>
        </a>
        <a href="../data_akun">
            <i class="ph ph-users"></i><span>Akun</span>
        </a>
        <a href="../data_buku_admin">
            <i class="ph ph-books"></i><span>Buku</span>
        </a>
        <a href="../peminjaman_admin">
            <i class="ph ph-hand-arrow-down"></i><span>Peminjaman</span>
        </a>
        <a href="../pengembalian_admin">
            <i class="ph ph-hand-arrow-up"></i><span>Pengembalian</span>
        </a>
    </aside>

    <main>
        <div class="data-buku">
            <div class="card">
                <div class="card-title">Jumlah Akun</div>
                <div class="card-value"><?= $totalAkun['total'] ?></div>
            </div>

            <div class="card">
                <div class="card-title">Total Buku</div>
                <div class="card-value"><?= $totalBuku['total'] ?></div>
            </div>

            <div class="card">
                <div class="card-title">Buku Dipinjam</div>
                <div class="card-value"><?= $dipinjam['total'] ?></div>
            </div>

            <div class="card">
                <div class="card-title">Buku Tersedia</div>
                <div class="card-value"><?= $tersedia['total'] ?></div>
            </div>

            <div class="card">
                <div class="card-title">Buku Hilang</div>
                <div class="card-value"><?= $hilang['total'] ?></div>
            </div>
        </div>

        <div class="cover-books">
            <div class="cover-book">
                <img src="../asset/cover1.avif" alt="cover buku 1">
            </div>
            <div class="cover-book">
                <img src="../asset/cover1.avif" alt="cover buku 2">
            </div>
            <div class="cover-book">
                <img src="../asset/cover1.avif" alt="cover buku 3">
            </div>
            <div class="cover-book">
                <img src="../asset/cover1.avif" alt="cover buku 4">
            </div>
            <div class="cover-book">
                <img src="../asset/cover1.avif" alt="cover buku 5">
            </div>
            <div class="cover-book">
                <img src="../asset/cover1.avif" alt="cover buku 6">
            </div>
            <div class="cover-book">
                <img src="../asset/cover1.avif" alt="cover buku 7">
            </div>
            <div class="cover-book">
                <img src="../asset/cover1.avif" alt="cover buku 8">
        </div>
        <div class="cover-book">
                <img src="../asset/cover1.avif" alt="cover buku 9">
            </div>
            <div class="cover-book">
                <img src="../asset/cover1.avif" alt="cover buku 10">
            </div>
    </main>
</body>

<script src="dashboard_admin/script.js"></script>
</html>