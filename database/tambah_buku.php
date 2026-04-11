<?php
session_start();
include __DIR__ . '/koneksi.php';

$judul = $_POST['judul'];
$penulis = $_POST['penulis'];
$penerbit = $_POST['penerbit'];
$tahun_terbit = $_POST['tahun_terbit'];
$jenis = $_POST['jenis'];
$stok = $_POST['stok'];
$cover = $_FILES['cover']['name'];
$tmp = $_FILES['cover']['tmp_name'];

$query = "INSERT INTO buku (judul, penulis, penerbit, tahun_terbit, jenis, stok, jumlah_tetap, cover)
          VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($koneksi, $query);

mysqli_stmt_bind_param($stmt, "ssssssss",
    $judul,
    $penulis,
    $penerbit,
    $tahun_terbit,
    $jenis,
    $stok,
    $stok,
    $cover
);

// folder tujuan
$folder = "../upload/";

$cover = time() . '_' . $_FILES['cover']['name'];
$tmp = $_FILES['cover']['tmp_name'];
$folder = "../upload/";

// cek ekstensi
$ext = strtolower(pathinfo($cover, PATHINFO_EXTENSION));
if ($ext != 'jpg' && $ext != 'png' && $ext != 'avif') {
    echo "File harus gambar!";
    exit;
}

// pindahin file (PAKAI NAMA BARU)
move_uploaded_file($tmp, $folder . $cover);

mysqli_stmt_execute($stmt);

header("Location: ../data_buku_admin");
exit;




?>

