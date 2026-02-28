<?php
session_start();
include __DIR__ . '/koneksi.php';

$judul = $_POST['judul'];
$penulis = $_POST['penulis'];
$penerbit = $_POST['penerbit'];
$tahun_terbit = $_POST['tahun_terbit'];
$jenis = $_POST['jenis'];
$stok = $_POST['stok'];

$query = "INSERT INTO buku (judul, penulis, penerbit, tahun_terbit, jenis, stok)
            VALUES (?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "ssssss", $judul, $penulis, $penerbit, $tahun_terbit, $jenis, $stok);
mysqli_stmt_execute($stmt);

header("Location: ../data_buku_admin");
exit;
?>