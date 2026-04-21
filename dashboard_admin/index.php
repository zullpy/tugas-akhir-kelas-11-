<?php
include '../database/dashboard.php';
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login_admin");
    exit;
}
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
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
            <form action="../database/logout.php" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin logout?')">
                <button>Log Out</button>
            </form>
        </div>
    </header>

    <aside>
        <a href="../dashboard_admin" class="active">
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
        <a href="../transaksi_admin">
            <i class="ph ph-cash-register"></i><span>Transaksi</span>
        </a>
        <a href="../riwayat_crud">
            <i class="ph ph-clock-counter-clockwise"></i><span>Activity Log</span>
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
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="cover-book <?= $row['stok'] == 0 ? 'habis' : '' ?>">
                    <img src="../upload/<?= $row['cover'] ?: 'default.jpg' ?>" width="120">
        
                <?php if ($row['stok'] == 0) { ?>
                    <div class="overlay">Stok Habis</div>
                <?php } ?>
                </div>
            <?php } ?>
        </div>
        
    </main>
</body>

<script src="dashboard_admin/script.js"></script>
</html>