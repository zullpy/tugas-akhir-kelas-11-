<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'koneksi.php';

$id = $_POST['id'];
$judul = $_POST['judul'];
$penulis = $_POST['penulis'];
$penerbit = $_POST['penerbit'];
$tahun = $_POST['tahun_terbit'];
$jenis = $_POST['jenis'];
$stok = $_POST['stok'];
$harga = $_POST['harga'];

$folder = "../upload/";

// ambil cover lama dulu
$query = mysqli_query($koneksi, "SELECT cover FROM buku WHERE id_buku='$id'");
$data = mysqli_fetch_assoc($query);
$cover_lama = $data['cover'];

// cek apakah upload gambar baru
if ($_FILES['cover']['name'] != "") {

    $cover = time() . '_' . $_FILES['cover']['name'];
    $tmp = $_FILES['cover']['tmp_name'];

    $ext = strtolower(pathinfo($cover, PATHINFO_EXTENSION));
    if ($ext != 'jpg' && $ext != 'png' && $ext != 'avif') {
        echo "File harus gambar!";
        exit;
    }

    // 🔹 upload file baru dulu
    move_uploaded_file($tmp, $folder . $cover);

    // BARU HAPUS FILE LAMA
    if (file_exists($folder . $cover_lama)) {
        unlink($folder . $cover_lama);
    }

    // update + cover baru
    $stmt = mysqli_prepare($koneksi,
        "UPDATE buku 
        SET cover=?, judul=?, penulis=?, penerbit=?, tahun_terbit=?, jenis=?, stok=?, jumlah_tetap=?, harga=?
        WHERE id_buku=?"
    );

    mysqli_stmt_bind_param($stmt, "ssssssiiii",
        $cover, $judul, $penulis, $penerbit, $tahun, $jenis, $stok, $stok, $harga, $id
    );

} else {

    // update tanpa ubah cover
    $stmt = mysqli_prepare($koneksi,
        "UPDATE buku 
        SET judul=?, penulis=?, penerbit=?, tahun_terbit=?, jenis=?, stok=?, jumlah_tetap=?, harga=?
        WHERE id_buku=?"
    );

    mysqli_stmt_bind_param($stmt, "ssssssiii",
        $judul, $penulis, $penerbit, $tahun, $jenis, $stok, $stok, $harga, $id
    );
}

mysqli_stmt_execute($stmt);

header("Location: ../data_buku_admin");
exit;
?>