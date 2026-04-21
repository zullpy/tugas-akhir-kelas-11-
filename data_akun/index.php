<?php
include '../database/akun.php';
mysqli_query($koneksi, "
    UPDATE users 
    SET status = 'nonaktif'
    WHERE last_login < NOW() - INTERVAL 1 MONTH
");
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
    <title>Data Akun</title>
    <link rel="shortcut icon" href="../asset/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="data_akun/style.css">
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
        <a href="../data_akun" class="active">
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
        <a href="../transaksi_admin">
            <i class="ph ph-cash-register"></i><span>Transaksi</span>
        </a>
        <a href="../riwayat_crud">
            <i class="ph ph-clock-counter-clockwise"></i><span>Activity Log</span>
        </a>
    </aside>
    
<main>
        <div class="data-buku">
            <div class="card">
                <div class="card-title">Jumlah Akun</div>
                <div class="card-value"><?= $akun['total'] ?></div>
                <div class="card-image">
                    <img src="../asset/people.png" alt="icon akun">
                </div>
            </div>

            <div class="card">
                <div class="card-title">Total Admin</div>
                <div class="card-value"><?= $akun_admin['total'] ?></div>
                <div class="card-image">
                    <img src="../asset/people2.png" alt="icon akun">
                </div>
            </div>

            <div class="card">
                <div class="card-title">Total User</div>
                <div class="card-value"><?= $akun_user['total'] ?></div>
                <div class="card-image">
                    <img src="../asset/people3.png" alt="icon akun">
                </div>
            </div>
        </div>

        <div class="table-container">
            <div class="header-table">
                <h2>Data Akun</h2>
                <button id="btnTambah">Tambah User</button>
            </div>
            <table border="1" cellspacing="0" cellpadding="10">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['username']) ?></td>
                <td><?= htmlspecialchars($row['kelas']) ?></td>
                <td><?= htmlspecialchars($row['jurusan']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td>
                    <span class="badge 
                        <?= $row['role'] == 'admin' ? 'bg-danger' : 'bg-primary' ?>">
                        <?= $row['role'] ?>
                    </span>
                </td>
                <td>
                    <span class="badge 
                        <?= $row['status'] == 'aktif' ? 'bg-success' : 'bg-secondary' ?>">
                        <?= $row['status'] ?>
                    </span>
                </td>
                <td>
                    <a href="../database/hapus_akun.php?id=<?= $row['id'] ?>&sumber=<?= $row['sumber'] ?>"
                        onclick="return confirm('Yakin mau hapus akun ini?')" class="button-delete" style="text-decoration: none;">
                        <i class="ph ph-trash-simple"> </i>
                    </a>
                </td>
            </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        </div>
    </div>
</main>

    <!-- Modal Tambah Admin -->
<div class="modal" id="modalAdmin">
    <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>
        <h3>Tambah Akun Admin</h3>

        <form action="../database/tambah_user.php" method="POST">
            <div class="form-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>

            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required>
            </div>

            <div class="form-group">
                <div class="password-wrapper">
                    <input type="password" name="password" id="input-password" placeholder="Password" required>
                    <i class="ph ph-eye" id="togglePassword"></i>
                </div>
            </div>

            <div class="form-group">
                <select name="kelas" id="">
                    <option value="" disabled selected>Pilih Kelas</option>
                    <option value="X">X</option>
                    <option value="XI">XI</option>
                    <option value="XII">XII</option>
                </select>
            </div>

            <div class="form-group">
                <input type="text" name="jurusan" placeholder="Jurusan" required>
            </div>

            <button type="submit" class="btn-submit">Tambah Admin</button>
        </form>
    </div>
</div>
    
</body>
<script src="data_akun/script.js"></script>
</html>

