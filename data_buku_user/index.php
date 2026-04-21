<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header("Location: ../login_user");
    exit;
}

include '../database/koneksi.php';

// =====================
// 🔍 FILTER
// =====================
$where = [];

// FILTER JENIS
if (!empty($_GET['jenis'])) {
    $jenis = mysqli_real_escape_string($koneksi, $_GET['jenis']);
    $where[] = "jenis = '$jenis'";
}

// FILTER STATUS (pakai stok)
if (!empty($_GET['status'])) {
    if ($_GET['status'] == 'Tersedia') {
        $where[] = "stok > 0";
    } elseif ($_GET['status'] == 'Dipinjam') {
        $where[] = "stok = 0";
    }
}

// SEARCH
if (!empty($_GET['search'])) {
    $search = mysqli_real_escape_string($koneksi, $_GET['search']);
    $where[] = "(judul LIKE '%$search%' 
                OR penulis LIKE '%$search%' 
                OR penerbit LIKE '%$search%')";
}

// QUERY
$query = "SELECT * FROM buku WHERE status != 'nonaktif'";

if (!empty($where)) {
    $query .= " AND " . implode(" AND ", $where);
}

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kumpulan Buku</title>

    <link rel="stylesheet" href="data_buku_user/style.css">
    <link rel="shortcut icon" href="../asset/favicon.ico">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css"/>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/fill/style.css"/>
</head>

<body>

<header>
    <div class="logo-right">
        <img src="../asset/logo.png">
        <h3>Sistem Peminjaman Buku
        <br><span>SMKS Sukapura</span></h3>
    </div>

    <div class="left">
        <h2>Selamat datang <?= $_SESSION['username'] ?>!!</h2>
        <form action="../database/logout.php" method="POST"
              onsubmit="return confirm('Apakah Anda yakin ingin logout?')">
            <button>Log Out</button>
        </form>
    </div>
</header>

<aside>
    <a href="../dashboard_user">
        <i class="ph ph-book-open"></i><span>Dashboard</span>
    </a>
    <a href="../data_buku_user" class="active">
        <i class="ph ph-books"></i><span>Buku</span>
    </a>
    <a href="../peminjaman_user">
        <i class="ph ph-hand-arrow-down"></i><span>Peminjaman</span>
    </a>
    <a href="../pengembalian_user">
        <i class="ph ph-hand-arrow-up"></i><span>Pengembalian</span>
    </a>
    <a href="../transaksi_user">
            <i class="ph ph-cash-register"></i><span>Transaksi</span>
    </a>
</aside>

<main>

<!-- FILTER -->
<div class="filter-wrapper">
    <i class="ph ph-faders-horizontal" id="btnFilter"></i>

    <div id="filterBox" class="filter-box">
        <i class="ph ph-x" onclick="closeFilterBox()"></i>

        <form method="GET">
            <select name="jenis">
                <option value="">Semua Jenis</option>
                <option value="Edukasi">Edukasi</option>
                <option value="Novel">Novel</option>
                <option value="Fiksi">Fiksi</option>
                <option value="NonFiksi">NonFiksi</option>
            </select>

            <select name="status">
                <option value="">Semua Status</option>
                <option value="Tersedia">Tersedia</option>
                <option value="Dipinjam">Dipinjam</option>
            </select>

            <button type="submit">Terapkan</button>
        </form>
    </div>

    <!-- SEARCH -->
    <form method="GET">
        <div class="search-bar">
            <input type="text" name="search" placeholder="Cari buku..."
                   value="<?= $_GET['search'] ?? '' ?>">
            <button type="submit">
                <i class="ph ph-magnifying-glass"></i>
            </button>
        </div>
    </form>
</div>

<!-- TABEL -->
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Judul Buku</th>
            <th>Pengarang</th>
            <th>Penerbit</th>
            <th>Tahun Terbit</th>
            <th>Jenis</th>
            <th>Jumlah Buku</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
    <?php
    $no = 1;
    while ($data = mysqli_fetch_assoc($result)) {
    ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $data['judul']; ?></td>
            <td><?= $data['penulis']; ?></td>
            <td><?= $data['penerbit']; ?></td>
            <td><?= $data['tahun_terbit']; ?></td>
            <td><?= $data['jenis']; ?></td>
            <td><?= $data['stok']; ?></td>

            <!-- STATUS TANPA ICON -->
            <td>
                <?php if ($data['stok'] == 0): ?>
                    <span class="status status-habis">Tidak Tersedia</span>
                <?php else: ?>
                    <span class="status status-tersedia">Tersedia</span>
                <?php endif; ?>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

</main>

<script src="data_buku_admin/script.js"></script>
</body>
</html>