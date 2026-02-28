<?php
include 'koneksi.php';

$id = $_POST['id'];
$judul = $_POST['judul'];
$penulis = $_POST['penulis'];
$penerbit = $_POST['penerbit'];
$tahun = $_POST['tahun_terbit'];
$jenis = $_POST['jenis'];
$stok = $_POST['stok'];

$stmt = mysqli_prepare($koneksi,
    "UPDATE buku 
    SET judul=?, penulis=?, penerbit=?, tahun_terbit=?, jenis=?, stok=? 
    WHERE id_buku=?"
);

mysqli_stmt_bind_param($stmt, "ssssssi",
    $judul, $penulis, $penerbit, $tahun, $jenis, $stok, $id
);

mysqli_stmt_execute($stmt);

header("Location: ../data_buku_admin");
exit;
?>