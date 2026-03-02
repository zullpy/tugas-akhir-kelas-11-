<?php
include "koneksi.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = mysqli_query($koneksi, "DELETE FROM peminjaman WHERE id_peminjaman = $id");
    if ($query) {
        header("Location: ../peminjaman_admin?msg=deleted");
        exit();
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
} else {
    echo "ID tidak ditemukan.";
}
