<?php
include "koneksi.php";

$id = $_GET['id'];

// ambil data
$data = mysqli_fetch_assoc(mysqli_query($koneksi, 
    "SELECT status FROM peminjaman WHERE id_peminjaman='$id'"
));

// pastikan masih dipinjam
if ($data['status'] != 'dipinjam') {
    header("Location: ../peminjaman_admin");
    exit;
}

// ubah status jadi hilang
mysqli_query($koneksi, 
    "UPDATE peminjaman SET status='hilang' WHERE id_peminjaman='$id'"
);

header("Location: ../peminjaman_admin");
exit;