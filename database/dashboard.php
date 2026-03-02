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
$qBuku = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM buku");
$totalBuku = mysqli_fetch_assoc($qBuku);

// TOTAL DIPINJAM
$qDipinjam = mysqli_query($koneksi, 
    "SELECT COUNT(*) AS total 
     FROM peminjaman 
     WHERE status = 'dipinjam'"
);
$dipinjam = mysqli_fetch_assoc($qDipinjam);

// TOTAL TERSEDIA
$qTersedia = mysqli_query($koneksi, 
    "SELECT COUNT(*) AS total 
     FROM buku 
     WHERE status = 'tersedia'"
);
$tersedia = mysqli_fetch_assoc($qTersedia);

// TOTAL HILANG
$qHilang = mysqli_query($koneksi, 
    "SELECT COUNT(*) AS total 
     FROM buku 
     WHERE status = 'hilang'"
);
$hilang = mysqli_fetch_assoc($qHilang);