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
    <title>Kumpulan Buku</title>
    <link rel="stylesheet" href="data_buku_admin/style.css">
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
        <a href="../data_akun" >
            <i class="ph ph-users"></i><span>Akun</span>
        </a>
        <a href="../data_buku_admin" class="active">
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
        <div class="filter-wrapper">
            <button class="tambah" id="btnTambahBuku">Tambah Buku</button>
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
            <form action="" method="get">
                <div class="search-bar">
                    <input type="text" name="search" id="searchInput" placeholder="Cari buku..." autocomplete="off" value="<?= $_GET['search'] ?? '' ?>">
                    <button type="submit"><i class="ph ph-magnifying-glass"></i></button>
                </div>
            </form>
        </div>
    <div class="table-container">
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
                    <th>Aksi</th>
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

                $search = $_GET['search'] ?? '';
                if (!empty($search)) {
                    $search = mysqli_real_escape_string($koneksi, $search);
                    $where[] = "(judul LIKE '%$search%' 
                                OR penulis LIKE '%$search%' 
                                OR penerbit LIKE '%$search%')";
                }   

                if (!empty($where)) {
                    $query .= " AND " . implode(" AND ", $where);
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
                    echo "<td>";
                    echo "<button class='edit'
                        onclick=\"openEditModal(
                        '" . $data['id_buku'] . "',
                        '" . htmlspecialchars($data['judul']) . "',
                        '" . htmlspecialchars($data['penulis']) . "',
                        '" . htmlspecialchars($data['penerbit']) . "',
                        '" . $data['tahun_terbit'] . "',
                        '" . $data['jenis'] . "',
                        '" . $data['stok'] . "'
                        )\"><i class='ph ph-pencil-simple'></i></button>";
                    echo "<a href='?hapus=" . $data['id_buku'] . "'><button class='hapus' 
                    onclick=\"return confirm('Apakah Anda yakin ingin menghapus buku ini?')\" class='hapus-link'>
                        <i class='ph ph-trash-simple'></i>
                    </a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>    
    </main>

    <div class="modal" id="modalBuku">
    <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>
        <h3>Tambah Buku</h3>

        <form action="../database/tambah_buku.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <input type="file" name="cover" placeholder="Cover Buku" required>
            </div>

            <div class="form-group">
                <input type="text" name="judul" placeholder="Judul Buku" required>
            </div>

            <div class="form-group">
                <input type="text" name="penulis" placeholder="Penulis" required>
            </div>

            <div class="form-group">
                <input type="text" name="penerbit" placeholder="Penerbit" required>
            </div>

            <div class="form-group">
                <input type="text" name="tahun_terbit" placeholder="Tahun Terbit" required>
            </div>

            <div class="form-group">
                <select name="jenis" required>
                    <option value="">Pilih Jenis</option>
                    <option value="edukasi">Edukasi</option>
                    <option value="fiksi">Fiksi</option>
                    <option value="non-fiksi">Non-Fiksi</option>
                    <option value="novel">Novel</option>
                </select>
            </div>

            <div class="form-group">
                <input type="number" name="stok" placeholder="Jumlah Buku" required>
            </div>

            <button type="submit" class="btn-submit">Tambah Buku</button>
        </form>
    </div>
</div>

<div id="editModal" class="modal2">
    <div class="modal-content2">
        <span onclick="closeEditModal()" style="cursor:pointer;">&times;</span>

        <form method="POST" action="../database/update_buku.php" enctype="multipart/form-data">
            <input type="hidden" name="id" id="edit_id">

            <h3>Edit Buku</h3>

            <label for="file">Cover Buku</label>
            <input type="file" name="cover" id="edit_cover">
            <label for="judul">judul buku</label>
            <input type="text" name="judul" id="edit_judul">
            <label for="penulis">penulis</label>
            <input type="text" name="penulis" id="edit_penulis">
            <label for="penerbit">penerbit</label>
            <input type="text" name="penerbit" id="edit_penerbit">
            <label for="tahun_terbit">tahun terbit</label>
            <input type="text" name="tahun_terbit" id="edit_tahun">
            <label for="jenis">jenis buku</label>
            <div class="form-group" id="edit_jenis">
                <select name="jenis" required>
                    <option value="">Pilih Jenis</option>
                    <option value="edukasi">Edukasi</option>
                    <option value="fiksi">Fiksi</option>
                    <option value="non-fiksi">Non-Fiksi</option>
                    <option value="novel">Novel</option>
                </select>
            </div>
            <label for="stok">jumlah buku</label>
            <input type="number" name="stok" id="edit_stok">

            <button type="submit">Update</button>
        </form>
    </div>
</div>
</body>
<script src="data_buku_admin/script.js"></script>
</html>