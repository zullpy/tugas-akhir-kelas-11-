<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "../database/koneksi.php";

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
WHERE peminjaman.status = 'dipinjam';");

$users = mysqli_query($koneksi, "SELECT * FROM users");
$buku  = mysqli_query($koneksi, "SELECT * FROM buku WHERE status='tersedia'");
if(!$users){
    die("Query users error: " . mysqli_error($koneksi));
}

if(!$buku){
    die("Query buku error: " . mysqli_error($koneksi));
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
            <h3>Sistem Peminjaman Buku</h3>
            <h3>SMKS Sukapura</h3>
        </div>

        <div class="left">
            <h2>selamat datang admin!!</h2>
            <a href="../login_admin" onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                <button>Log Out</button>
            </a>
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
        <a href="../pengembalian_admin">
            <i class="ph ph-hand-arrow-up"></i><span>Pengembalian</span>
        </a>
    </aside>

    <div class="button-wrapper" id="btnTambahPeminjaman">
            <i class="ph ph-plus"></i> Tambah Data Peminjaman
    </div>

    <main>
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
                    <th>Aksi</th>
                </tr>

            <?php while($data = mysqli_fetch_assoc($query)) { ?>
                <tr>
                    <td><?= $data['id_peminjaman']; ?></td>
                    <td><?= $data['nama_peminjam']; ?></td>
                    <td><?= $data['judul']; ?></td>
                    <td><?= $data['tanggal_pinjam']; ?></td>
                    <td><?= $data['tanggal_kembali']; ?></td>
                    <td><?= $data['no_wa']; ?></td>
                    <td><?= $data['status']; ?></td>
                    <td>
                        <a href="../edit_peminjaman_admin?id=<?= $data['id_peminjaman']; ?>"><i class="ph ph-pencil"></i></a>
                        <a href="../hapus_peminjaman_admin?id=<?= $data['id_peminjaman']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="ph ph-trash-simple"></i></a>
                        <?php if($data['status'] == 'dipinjam'){ ?>
                            <a href="../database/proses_kembali.php?id=<?= $data['id_peminjaman']; ?>" 
                                onclick="return confirm('Yakin mau kembalikan buku?')">
                                <i class="ph ph-check-circle"></i>
                            </a>
                        <?php } ?>
                        <i class="ph ph-warning-circle"></i>
                    </td>
                </tr>
            <?php } ?>
            </thead>
            <tbody id="peminjaman-table-body">
                
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
                <select name="id_buku" required>
                    <option value="">-- Pilih Buku --</option>
                    <?php while($b = mysqli_fetch_assoc($buku)) { ?>
                        <option value="<?= $b['id_buku']; ?>">
                            <?= $b['judul']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <!-- PILIH USER -->
            <div class="form-group">
                <select name="id_user" required>
                    <option value="">-- Pilih Peminjam --</option>
                    <?php while($u = mysqli_fetch_assoc($users)) { ?>
                        <option value="<?= $u['id_user']; ?>">
                            <?= $u['username']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <input type="date" name="tanggal_pinjam" required>
            </div>

            <div class="form-group">
                <input type="date" name="tanggal_kembali" required>
            </div>

            <div class="form-group">
                <input type="text" name="no_wa" placeholder="Nomor WhatsApp" required>
            </div>
            <button type="submit" class="btn-submit">
                Tambah Peminjaman
            </button>

        </form>
    </div>
</div>
</body>
<script src="peminjaman_admin/script.js"></script>
</html>