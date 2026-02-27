<?php
include '../database/akun.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Akun</title>
    <link rel="shortcut icon" href="../asset/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
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
    <div class="wrapper-card">
        <div class="card">
            <h4 class="card-title">Jumlah Akun</h4>
            <p class="card-value"><?= $akun['total'] ?></p>
            <img src="../asset/people3." alt="" class="card-image">
        </div>

        <div class="card">
            <h4 class="card-title">Akun Admin</h4>
            <p class="card-value"><?= $akun_admin['total'] ?></p>
            <img src="../asset/people2." alt="" class="card-image">
        </div>

        <div class="card">
            <h4 class="card-title">Akun User</h4>
            <p class="card-value"><?= $akun_user['total'] ?></p>
            <img src="../asset/people." alt="" class="card-image">
        </div>
    </div>

    <aside>
        <a href="../dashboard_admin">
            <i class="ph ph-book-open"></i><span>Dashboard</span>
        </a>
        <a href="../data_akun">
            <i class="ph ph-users"></i><span>Akun</span>
        </a>
        <a href="../data_buku">
            <i class="ph ph-books"></i><span>Buku</span>
        </a>
        <a href="../peminjaman">
            <i class="ph ph-hand-arrow-down"></i><span>Peminjaman</span>
        </a>
        <a href="../pengembalian">
            <i class="ph ph-hand-arrow-up"></i><span>Pengembalian</span>
        </a>
    </aside>

    <div class="table-akun">
        <table border="1" cellspacing="0" cellpadding="10">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['username']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td>
                    <span class="badge 
                        <?= $row['role'] == 'admin' ? 'bg-danger' : 'bg-primary' ?>">
                        <?= $row['role'] ?>
                    </span>
                </td>
                <td>
                    <a href="../database/hapus_akun.php?id=<?= $row['id'] ?>&sumber=<?= $row['sumber'] ?>"
                        onclick="return confirm('Yakin mau hapus akun ini?')">
                        <i class="ph ph-trash"></i>
                    </a>
                </td>
            </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        
        <div class="add">
            <a href="" id="btnTambahAdmin">
                <i class="ph ph-plus"></i> Tambah Akun Admin
            </a>
        </div>
    </div>


    
</body>
<script src="script.js"></script>
</html>

