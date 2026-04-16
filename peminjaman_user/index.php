<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "../database/koneksi.php";
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../login_user");
    exit;
}

$id_user = $_SESSION['id_user'];

$query = mysqli_query($koneksi, "SELECT peminjaman.id_peminjaman,
        users.username AS nama_peminjam,
        buku.judul AS judul,
        peminjaman.tanggal_pinjam,
        peminjaman.tanggal_kembali,
        peminjaman.no_wa,
        peminjaman.status
FROM peminjaman
JOIN users ON peminjaman.id_user = users.id_user
JOIN buku ON peminjaman.id_buku = buku.id_buku
WHERE peminjaman.status = 'dipinjam' AND peminjaman.id_user = $id_user");

$users = mysqli_query($koneksi, "SELECT * FROM users");
$buku  = mysqli_query($koneksi, "SELECT * FROM buku WHERE status='tersedia'");
if(!$users){
    die("Query users error: " . mysqli_error($koneksi));
}

if(!$buku){
    die("Query buku error: " . mysqli_error($koneksi));
}
?>
<?php

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
    <title>Peminjaman Buku</title>
    <link rel="stylesheet" href="peminjaman_user/style.css">
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
            <h2>selamat datang <?php echo $_SESSION['username']; ?>!</h2>
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
        <a href="../peminjaman_user" class="active">
            <i class="ph ph-hand-arrow-down"></i><span>Peminjaman</span>
        </a>
        <a href="../pengembalian_user">
            <i class="ph ph-hand-arrow-up"></i><span>Pengembalian</span>
        </a>
    </aside>

    <main>
    <div class="button-wrapper" id="btnTambahPeminjaman">
            <i class="ph ph-plus"></i> Tambah Data Peminjaman
    </div>
        <table cellspacing="0" cellpadding="10" border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peminjam</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>nomor whatsapp</th>
                    <th>Status</th>
                </tr>

            
            </thead>
            <tbody id="peminjaman-table-body">
                <?php 
                    $no= 1;
                    while($data = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?= $data['nama_peminjam']; ?></td>
                            <td><?= $data['judul']; ?></td>
                            <td><?= $data['tanggal_pinjam']; ?></td>
                            <td><?= $data['tanggal_kembali']; ?></td>
                            <td><?= $data['no_wa']; ?></td>
                            <td><?= $data['status']; ?></td>
                        </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
    
    

<div class="modal" id="modalBuku">
    <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>
        <h3>Tambah Peminjaman</h3>

        <form action="../database/tambah_peminjaman.php" method="POST">

            <!-- PILIH BUKU -->
            <div class="form-group">
                <input type="text" id="searchBuku" placeholder="Cari judul buku..." autocomplete="off">

                    <div id="listBuku" class="dropdown-list">
                        <?php while($b = mysqli_fetch_assoc($buku)) { ?>
                            <div class="item" data-id="<?= $b['id_buku']; ?>">
                            <?= $b['judul']; ?>
                            </div>
                        <?php } ?>  
                    </div>

                <!-- hidden input buat kirim id -->
                <input type="hidden" name="id_buku" id="id_buku">
            </div>

            <!-- PILIH USER -->
            <div class="form-group">
                <select disabled>
                    <option>
                        <?= $_SESSION['username']; ?>
                    </option>
                </select>
                <input type="hidden" name="id_user" value="<?= $_SESSION['id_user']; ?>">
            </div>

            <div class="form-group">
                <input type="date" name="tanggal_pinjam" value="<?= date('Y-m-d') ?>" readonly>
            </div>

            <div class="form-group">
                <input type="date" name="tanggal_kembali" id="tgl_kembali" required>
            </div>

            <div class="form-group">
                <input type="text" name="no_wa" placeholder="Nomor WhatsApp (628XXXXXXXXX)" required>
            </div>
            <button type="submit" class="btn-submit">
                Tambah Peminjaman
            </button>

        </form>
    </div>
</div>


</body>
<script src="peminjaman_user/script.js"></script>
</html>