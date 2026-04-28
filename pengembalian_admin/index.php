<?php
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
    <title>Pengembalian Buku</title>
    <link rel="stylesheet" href="pengembalian_admin/style.css">
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
            <form action="../database/logout.php" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin logout?')">
                <button>Log Out</button>
            </form>
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
        <a href="../pengembalian_admin" class="active">
            <i class="ph ph-hand-arrow-up"></i><span>Pengembalian</span>
        </a>
        <a href="../transaksi_admin">
            <i class="ph ph-cash-register"></i><span>Transaksi</span>
        </a>
    </aside>

    <main>        
        <?php
        include '../database/koneksi.php';

        $query = mysqli_query($koneksi, "
            SELECT p.*, u.username, b.judul 
            FROM peminjaman p
            JOIN users u ON p.id_user = u.id_user
            JOIN buku b ON p.id_buku = b.id_buku
            WHERE p.status = 'dikembalikan' OR p.status = 'hilang'
            ORDER BY p.id_peminjaman ASC"
            );
        ?>

        <h2>Data Pengembalian</h2>
    <div class="table-container">
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>nama</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>No WA</th>
                <th>Status</th>
            </tr>

        <?php $no = 1; while($data = mysqli_fetch_assoc($query)){ ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['username']; ?></td>
                <td><?= $data['judul']; ?></td>
                <td><?= $data['tanggal_pinjam']; ?></td>
                <td><?= $data['tanggal_kembali']; ?></td>
                <td><?= $data['no_wa']; ?></td>
                <td><?= $data['status']; ?></td>
            </tr>
        <?php } ?>
        </table>
    </div>
    </main>
    
</body>
<script src="pengembalian_admin/script.js"></script>
</html>