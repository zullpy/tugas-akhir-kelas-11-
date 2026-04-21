<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header("Location: ../login_user");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengembalian Buku</title>
    <link rel="stylesheet" href="pengembalian_user/style.css">
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
            <?php session_start(); ?>
            <h2>selamat datang <?php echo $_SESSION['username']; ?>!!</h2>
            <form action="../database/logout.php" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin logout?')">
                <button>Log Out</button>
            </form>
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
        <a href="../pengembalian_user" class="active">
            <i class="ph ph-hand-arrow-up"></i><span>Pengembalian</span>
        </a>
        
    </aside>

    <main>        
        <?php
        include '../database/koneksi.php';

        session_start();
        if (!isset($_SESSION['id_user'])) {
        header("Location: ../login_user.php");
        exit;
        }
        $id_user = $_SESSION['id_user'];        

        $query = mysqli_query($koneksi, "
                SELECT p.*, b.judul 
                FROM peminjaman p
                JOIN buku b ON p.id_buku = b.id_buku
                WHERE p.status = 'dikembalikan' AND p.id_user = $id_user
                ORDER BY p.id_peminjaman ASC");
        ?>

        <h2>Data Pengembalian</h2>

        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>No WA</th>
                <th>Status</th>
            </tr>

        <?php $no = 1; while($data = mysqli_fetch_assoc($query)){ ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['judul']; ?></td>
                <td><?= $data['tanggal_pinjam']; ?></td>
                <td><?= $data['tanggal_kembali']; ?></td>
                <td><?= $data['no_wa']; ?></td>
                <td><?= $data['status']; ?></td>
            </tr>
        <?php } ?>
        </table>
    </main>
    
</body>
<script src="pengembalian_user/script.js"></script>
</html>