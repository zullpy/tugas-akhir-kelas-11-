<?php
include "koneksi.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $ambil = mysqli_query($koneksi, "SELECT id_buku FROM peminjaman WHERE id_peminjaman = $id");
    $data = mysqli_fetch_assoc($ambil);

    if ($data) {
        $id_buku = $data['id_buku'];

        mysqli_query($koneksi, "
            UPDATE buku 
            SET 
                stok = stok + 1,
                status = 'tersedia'
            WHERE id_buku = $id_buku
        ");

        $hapus = mysqli_query($koneksi, "DELETE FROM peminjaman WHERE id_peminjaman = $id");

        if ($hapus) {
            header("Location: ../peminjaman_admin?msg=deleted");
            exit();
        } else {
            echo "<script>
                alert('Gagal menghapus data!');
                window.location='../peminjaman_admin';
            </script>";
        }

    } else {
        echo "<script>
            alert('Data peminjaman tidak ditemukan!');
            window.location='../peminjaman_admin';
        </script>";
    }

} else {
    echo "<script>
        alert('ID tidak ditemukan.');
        window.location='../peminjaman_admin';
    </script>";
}