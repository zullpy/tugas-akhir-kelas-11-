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
            <h3>Sistem Peminjaman Buku
            <br><span>SMKS Sukapura</span></h3>
        </div>

        <div class="left">
            <h2>selamat datang <?= $_SESSION['username'] ?>!!</h2>
            <a href="../" 
            onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                <button>Log Out</button>
            </a>
        </div>
    </header>

    <aside>
        <a href="../dashboard_user" class="active">
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

    <main>
        <div class="data-buku">
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
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="cover-book">
                    <img src="../upload/<?= $row['cover'] ?: 'default.jpg' ?>" width="120">
                </div>
            <?php } ?>
            <div class="cover-book">
                <img src="../asset/cover1.avif" alt="cover buku 2">
            </div>
        </div>
    </main>
</body>
<script src="dashboard_user/script.js"></script>
</html>