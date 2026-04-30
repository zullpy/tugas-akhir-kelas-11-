<?php
include 'koneksi.php';

// total admin
$qAdmin = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM admin");
$admin = mysqli_fetch_assoc($qAdmin);

// total user
$qUser = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM users");
$user = mysqli_fetch_assoc($qUser);

// total semua akun
$totalAkun['total'] = $admin['total'] + $user['total'];

// TOTAL BUKU
$qTotal = mysqli_query($koneksi, "
    SELECT SUM(jumlah_tetap) AS total 
    FROM buku 
    WHERE status != 'nonaktif'
");
$totalBuku = mysqli_fetch_assoc($qTotal);

// TOTAL DIPINJAM
$qDipinjam = mysqli_query($koneksi, 
    "SELECT count(*) AS total 
     FROM peminjaman 
     WHERE status = 'dipinjam'"
);
$dipinjam = mysqli_fetch_assoc($qDipinjam);

// TOTAL TERSEDIA
$qTersedia = mysqli_query($koneksi, "
    SELECT SUM(stok) AS total 
    FROM buku 
    WHERE status != 'nonaktif'
");
$tersedia = mysqli_fetch_assoc($qTersedia);

// TOTAL HILANG
$qHilang = mysqli_query($koneksi, 
    "SELECT COUNT(*) AS total 
     FROM transaksi
     WHERE status = 'hilang'"
);
$hilang = mysqli_fetch_assoc($qHilang);


// cover buku
$result = mysqli_query($koneksi, "SELECT * FROM buku WHERE status != 'nonaktif' and cover != '' ORDER BY id_buku DESC ");