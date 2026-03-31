<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kumpulan Buku</title>
    <link rel="stylesheet" href="data_buku_user/style.css">
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
    <?php
    session_start();
    ?>
    <header>
        <div class="logo-right">
            <img src="../asset/logo.png" alt="logo">
            <h3>Sistem Peminjaman Buku</h3>
            <h3>SMKS Sukapura</h3>
        </div>

        <div class="left">
                <h2>selamat datang <?= isset($_SESSION['username']) ? ', ' . htmlspecialchars($_SESSION['username']) : '' ?>!</h2>
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

    <main>
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
        </div>
        <table border="1" cellspacing="0" cellpadding="10">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>jenis</th>
                    <th>Jumlah Buku</th>
                    <th>status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../database/koneksi.php';
                if (isset($_GET['hapus'])) {
                    $id = intval($_GET['hapus']);

                    $cek = mysqli_prepare($koneksi, 
                        "SELECT id_buku FROM peminjaman WHERE id_buku = ? AND status = 'dipinjam' LIMIT 1");
                        mysqli_stmt_bind_param($cek, "i", $id);
                        mysqli_stmt_execute($cek);
                        mysqli_stmt_store_result($cek);

                if (mysqli_stmt_num_rows($cek) > 0) {
                echo "<script>
                    alert('Buku masih dipinjam! Tidak bisa dinonaktifkan.');
                    window.location='data_buku_admin';
                </script>";
                } else {
                    $update = mysqli_prepare($koneksi,
                    "UPDATE buku SET status = 'nonaktif' WHERE id_buku = ?");
                    mysqli_stmt_bind_param($update, "i", $id);
                    mysqli_stmt_execute($update);
                    echo "<script>
                        alert('Buku berhasil dinonaktifkan.');
                        window.location='data_buku_admin';
                    </script>";
                }
                }
                $where = [];
                if (!empty($_GET['jenis'])) {
                    $jenis = mysqli_real_escape_string($koneksi, $_GET['jenis']);
                    $where[] = "jenis = '$jenis'";
                }

                if (!empty($_GET['status'])) {
                    $status = mysqli_real_escape_string($koneksi, $_GET['status']);
                    $where[] = "status = '$status'";
                }

                $query = "SELECT * FROM buku WHERE status != 'nonaktif'";

                if (!empty($where)) {
                    $query .= " AND " . implode(" AND ", $where);
                }

                $result = mysqli_query($koneksi, $query);
                $no = 1;
                while ($data = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $data['judul'] . "</td>";
                    echo "<td>" . $data['penulis'] . "</td>";
                    echo "<td>" . $data['penerbit'] . "</td>";
                    echo "<td>" . $data['tahun_terbit'] . "</td>";
                    echo "<td>" . $data['jenis'] . "</td>";
                    echo "<td>" . $data['stok'] . "</td>";
                    echo "<td>" . $data['status'] . "</td>";
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
<script src="data_buku_admin/script.js"></script>
</html>