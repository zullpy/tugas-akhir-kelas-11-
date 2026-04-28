<?php
include 'koneksi.php';

$id = $_GET['id'];

// ambil data transaksi dulu
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "
    SELECT * FROM transaksi WHERE id_transaksi = '$id'
"));

$today = date('Y-m-d');
$tgl_kembali = $data['tanggal_kembali'];

// hitung telat
$hari_telat = 0;
if ($today > $tgl_kembali) {
    $hari_telat = floor((strtotime($today) - strtotime($tgl_kembali)) / (60 * 60 * 24));
}

// hitung denda FIX
$denda = $hari_telat * 5000;

// update
mysqli_query($koneksi, "
    UPDATE transaksi 
    SET status = 'lunas',
        tanggal_bayar = '$today',
        denda = '$denda'
    WHERE id_transaksi = '$id'
");

// balik ke halaman
header("Location: ../transaksi_admin");
exit;