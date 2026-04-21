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
        <a href="../dashboard_user">
            <i class="ph ph-book-open"></i><span>Dashboard</span>
        </a>
        <a href="../data_buku_user">
            <i class="ph ph-books"></i><span>Buku</span>
        </a>
        <a href="../peminjaman_user">
            <i class="ph ph-hand-arrow-down"></i><span>Peminjaman</span>
        </a>
        <a href="../pengembalian_user" >
            <i class="ph ph-hand-arrow-up"></i><span>Pengembalian</span>
        </a>
        <a href="../transaksi_user" class="active">
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
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                include '../database/koneksi.php';

                session_start();
                $id_user = $_SESSION['id_user'];

                // ambil data dari tabel transaksi
                $query = mysqli_query($koneksi, "
                    SELECT transaksi.*, users.username, buku.judul
                    FROM transaksi
                    JOIN users ON transaksi.id_user = users.id_user
                    JOIN buku ON transaksi.id_buku = buku.id_buku
                    WHERE transaksi.id_user = $id_user
                ");

                while ($data = mysqli_fetch_assoc($query)) {
                    $today = date('Y-m-d');
                    $tgl_kembali = $data['tanggal_kembali'];

                    $hari_telat = 0;
                    $denda = 0;

                    if ($today > $tgl_kembali) {
                        $hari_telat = floor((strtotime($today) - strtotime($tgl_kembali)) / (60 * 60 * 24));
                        $denda = $hari_telat * 5000;
                    }
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $data['username']; ?></td>
                    <td><?= $data['judul']; ?></td>
                    <td><?= date('d-m-Y', strtotime($data['tanggal_pinjam'])); ?></td>
                    <td><?= date('d-m-Y', strtotime($data['tanggal_kembali'])); ?></td>
                    <td>
                        <?= ($hari_telat > 0) ? $hari_telat . " hari" : "-"; ?>
                    </td>
                    <td>
                        <?php if ($data['status'] == 'lunas') { ?>
                            <span style="color:green; font-weight:bold;">Lunas</span>
                        <?php } else { ?>
                            <span style="color:red;">Terlambat</span>
                        <?php } ?>
                    </td>
                    <td>
                            Rp. <?= number_format($denda, 0, ',', '.'); ?>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
        </table>
    </main>
</body>
</html>