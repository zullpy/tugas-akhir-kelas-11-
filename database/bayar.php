<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // update status langsung ke database
    $update = mysqli_query($koneksi, "
        UPDATE transaksi 
        SET status = 'lunas' 
        WHERE id_transaksi = '$id'
    ");

    if ($update) {
        echo "<script>
            alert('Status berhasil diubah ke lunas!');
            window.location.href='../transaksi_admin';
        </script>";
    } else {
        echo "Gagal update: " . mysqli_error($koneksi);
    }
} else {
    echo "ID tidak ditemukan!";
}