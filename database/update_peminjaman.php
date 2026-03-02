<?php
include "koneksi.php";

$id = $_POST['id'];
$id_user = $_POST['id_user'];
$id_buku = $_POST['id_buku'];
$tgl_pinjam = $_POST['tgl_pinjam'];
$tgl_kembali = $_POST['tgl_kembali'];
$wa = $_POST['no_wa'];
$status = $_POST['status'];

$update = mysqli_prepare($koneksi,
    "UPDATE peminjaman 
    SET id_user=?, 
        id_buku=?, 
        tanggal_pinjam=?, 
        tanggal_kembali=?, 
        no_wa=?, 
        status=? 
    WHERE id_peminjaman=?"
);

mysqli_stmt_bind_param($update, "iissssi",
    $id_user,
    $id_buku,
    $tgl_pinjam,
    $tgl_kembali,
    $wa,
    $status,
    $id
);

mysqli_stmt_execute($update);

header("Location: ../peminjaman_admin");