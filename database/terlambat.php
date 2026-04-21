<?php
include 'koneksi.php';

$today = date('y-m-d');

// 1. MASUKIN KE TRANSAKSI
$insert = mysqli_query($koneksi, "
INSERT INTO transaksi (id_user, id_buku, tanggal_pinjam, tanggal_kembali, no_wa)
SELECT id_user, id_buku, tanggal_pinjam, tanggal_kembali, no_wa
FROM peminjaman
WHERE tanggal_kembali < '$today'
AND status = 'dipinjam'
");

// cek error insert
if(!$insert){
    die("Error insert: " . mysqli_error($koneksi));
}

// 2. HAPUS DARI PEMINJAMAN_ADMIN
$delete = mysqli_query($koneksi, "
DELETE FROM peminjaman
WHERE tanggal_kembali < '$today'
AND status = 'dipinjam'
");

// cek error delete
if(!$delete){
    die("Error delete: " . mysqli_error($koneksi));
}
?>