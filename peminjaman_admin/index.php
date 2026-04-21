<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "../database/koneksi.php";
include '../database/terlambat.php';

$query = mysqli_query($koneksi, "SELECT 
    peminjaman.id_peminjaman,
    peminjaman.id_user,
    peminjaman.id_buku,
    users.username AS nama_peminjam,
    buku.judul AS judul,
    peminjaman.tanggal_pinjam,
    peminjaman.tanggal_kembali,
    peminjaman.no_wa,
    peminjaman.status
FROM peminjaman
JOIN users ON peminjaman.id_user = users.id_user
JOIN buku ON peminjaman.id_buku = buku.id_buku
WHERE peminjaman.status = 'dipinjam'");

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
    <title>Peminjaman Buku</title>
    <link rel="stylesheet" href="peminjaman_admin/style.css">
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
        <a href="../peminjaman_admin" class="active">
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
    <div class="button-wrapper" id="btnTambahPeminjaman">
            <i class="ph ph-plus"></i> Tambah Data Peminjaman
    </div>
    <div class="table-container">
        <table >
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peminjam</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>nomor whatsapp</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>

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
                    <td>
                        <a class="btn-edit"
                            data-id="<?= $data['id_peminjaman']; ?>"
                            data-id_user="<?= $data['id_user']; ?>"
                            data-id_buku="<?= $data['id_buku']; ?>"
                            data-pinjam="<?= $data['tanggal_pinjam']; ?>"
                            data-kembali="<?= $data['tanggal_kembali']; ?>"
                            data-wa="<?= $data['no_wa']; ?>">
                            <i class="ph ph-pencil"></i>
</a>
                        <a href="../database/hapus_peminjaman.php?id=<?= $data['id_peminjaman']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            <i class="ph ph-trash-simple"></i>
                        </a>
                        <?php if($data['status'] == 'dipinjam'){ ?>
                            <a href="../database/proses_kembali.php?id=<?= $data['id_peminjaman']; ?>" 
                                onclick="return confirm('Yakin mau kembalikan buku?')">
                                <i class="ph ph-check-circle"></i>
                            </a>
                        <?php } ?>
                        <a href="../database/buku_hilang.php?id=<?= $data['id_peminjaman']; ?>" 
                            onclick="return confirm('Yakin buku ini hilang?')">
                            <i class="ph ph-warning-circle"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </thead>
            <tbody id="peminjaman-table-body">
                
            </tbody>
        </table>
    </div>
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
            <div class="form-group" style="position: relative;">
                <input type="text" id="searchUser" placeholder="Cari user..." autocomplete="off">

                    <div id="listUser" class="dropdown-list">
                        <?php while($u = mysqli_fetch_assoc($users)) { ?>
                            <div class="item-user" data-id="<?= $u['id_user']; ?>">
                                <?= $u['username']; ?>
                            </div>
                        <?php } ?>
                    </div>

                <!-- hidden input -->
                <input type="hidden" name="id_user" id="id_user">
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

<div id="modalEdit" class="modal">
    <div class="modal-content">
        <span id="closeModal2">&times;</span>
            <h3>Edit Peminjaman</h3>
                <form method="POST" action="../database/update_peminjaman.php">
                    <input type="hidden" name="id" id="edit_id">

                    Nama:
                    <select name="id_user" id="edit_user">
                        <option value=''>-- Pilih Peminjam --</option>
                        <?php
                        $u = mysqli_query($koneksi, "SELECT * FROM users");
                        while($user = mysqli_fetch_assoc($u)){
                            echo "
                            <option value='{$user['id_user']}'>{$user['username']}</option>";
                        }
                        ?>
                    </select>
                    <br>
                    <br>

                    Judul Buku:
                    <select name="id_buku" id="edit_buku">
                        <?php
                        $b = mysqli_query($koneksi, "SELECT * FROM buku WHERE status!='nonaktif' and stok > 0");
                        while($buku = mysqli_fetch_assoc($b)){
                            echo "<option value='{$buku['id_buku']}'>{$buku['judul']}</option>";
                        }
                        ?>
                    </select>
                    <br>
                    <br>

                    Tanggal Pinjam:
                    <input type="date" name="tgl_pinjam" id="edit_pinjam"><br><br>

                    Tanggal Kembali:
                    <input type="date" name="tgl_kembali" id="edit_kembali"><br><br>

                    No WA:
                    <input type="text" name="no_wa" id="edit_wa"><br><br>

                    <button type="submit">Update</button>
                </form>
    </div>
</div>

</body>
<script src="peminjaman_admin/script.js"></script>
</html>