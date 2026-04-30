<?php
include 'koneksi.php';

$id = $_GET['id'];

// ambil data transaksi + relasi ke buku
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "
    SELECT t.*, p.id_buku, b.harga
    FROM transaksi t
    JOIN peminjaman p ON t.id_peminjaman = p.id_peminjaman
    JOIN buku b ON p.id_buku = b.id_buku
    WHERE t.id_transaksi = '$id'
"));

$today = date('Y-m-d');

// 🔥 denda hilang = harga buku
$denda = $data['harga'];

// update transaksi jadi lunas
mysqli_query($koneksi, "
    UPDATE transaksi 
    SET status = 'lunas',
        tanggal_bayar = '$today',
        jumlah = '$denda'
    WHERE id_transaksi = '$id'
");

// 🔥 kurangi stok buku (karena hilang)
mysqli_query($koneksi, "
    UPDATE buku 
    SET stok = stok - 1,
        jumlah_tetap = jumlah_tetap - 1
    WHERE id_buku = '{$data['id_buku']}'
");

header("Location: ../transaksi_admin");
exit;