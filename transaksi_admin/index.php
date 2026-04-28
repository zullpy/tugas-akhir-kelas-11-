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
    <title>Transaksi</title>
    <link rel="stylesheet" href="transaksi_admin/style.css">
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
        <a href="../pengembalian_admin" >
            <i class="ph ph-hand-arrow-up"></i><span>Pengembalian</span>
        </a>
        <a href="../transaksi_admin" class="active">
            <i class="ph ph-cash-register"></i><span>Transaksi</span>
        </a>
    </aside>

    <main>
        <h1>Transaksi</h1>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peminjam</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>hari terlambat</th>
                    <th>status</th>
                    <th>Denda</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                include '../database/koneksi.php';

                // ambil data dari tabel transaksi
                $query = mysqli_query($koneksi, "
                    SELECT transaksi.*, users.username, buku.judul
                    FROM transaksi
                    JOIN users ON transaksi.id_user = users.id_user
                    JOIN buku ON transaksi.id_buku = buku.id_buku
                ");

                while ($data = mysqli_fetch_assoc($query)) {

                    $tgl_kembali = $data['tanggal_kembali'];

                    // tentukan tanggal acuan
                    if ($data['status'] == 'lunas' && !empty($data['tanggal_bayar'])) {
                        $tanggal_acuan = $data['tanggal_bayar'];
                    } else {
                        $tanggal_acuan = date('Y-m-d');
                    }

                    // hitung keterlambatan
                    $hari_telat = 0;
                    if ($tanggal_acuan > $tgl_kembali) {
                        $hari_telat = floor((strtotime($tanggal_acuan) - strtotime($tgl_kembali)) / (60 * 60 * 24));
                    }

                    //  denda
                    if ($data['status'] == 'lunas') {
                        $denda = $data['denda']; // ambil dari DB (biar fix)
                    } else {
                        $denda = $hari_telat * 5000;
                    }

                    $is_telat = $hari_telat > 0;
                    $is_lunas = $data['status'] == 'lunas';
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $data['username']; ?></td>
                    <td><?= $data['judul']; ?></td>
                    <td><?= date('d-m-Y', strtotime($data['tanggal_pinjam'])); ?></td>
                    <td><?= date('d-m-Y', strtotime($data['tanggal_kembali'])); ?></td>

                    <td><?= $is_telat ? $hari_telat . " hari" : "-"; ?></td>

                    <td>
                        <?php if ($is_lunas) { ?>
                            <span style="color:green; font-weight:bold;">Lunas</span>
                        <?php } elseif ($is_telat) { ?>
                            <span style="color:red;">Terlambat</span>
                        <?php } else { ?>
                            <span>Dipinjam</span>
                        <?php } ?>
                    </td>

                    <td>Rp. <?= number_format($denda, 0, ',', '.'); ?></td>

                    <td>
                        <?php if ($is_telat && !$is_lunas) { ?>
                            <a href="../database/bayar.php?id=<?= $data['id_transaksi']; ?>"
                               onclick="return confirm('Yakin sudah dibayar?')">
                                Bayar
                            </a>
                        <?php } else { ?>
                            -
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
        </table>
    </main>
</body>
</html>