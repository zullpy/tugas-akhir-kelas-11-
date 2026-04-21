<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "koneksi.php";

// ambil data dari form
$id = $_POST['id'];
$id_user = $_POST['id_user'];
$id_buku = $_POST['id_buku'];
$tgl_pinjam = $_POST['tgl_pinjam'];
$tgl_kembali = $_POST['tgl_kembali'];
$no_wa = $_POST['no_wa'];

// validasi sederhana
if(empty($id) || empty($id_user) || empty($id_buku)){
    die("Data tidak lengkap!");
}

// query update
$query = mysqli_query($koneksi, "UPDATE peminjaman SET
    id_user = '$id_user',
    id_buku = '$id_buku',
    tanggal_pinjam = '$tgl_pinjam',
    tanggal_kembali = '$tgl_kembali',
    no_wa = '$no_wa'
WHERE id_peminjaman = '$id'
");

// cek hasil
if($query){
    echo "<script>
        alert('Data berhasil diupdate!');
        window.location.href = '../peminjaman_admin';
    </script>";
} else {
    echo "Gagal update: " . mysqli_error($koneksi);
}
?>