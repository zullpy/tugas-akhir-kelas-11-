<?php
include 'koneksi.php';

$id_peminjaman = $_GET['id'];

$koneksi->begin_transaction();

try {

    // 1. ambil id_buku dari peminjaman
    $ambil = $koneksi->prepare("SELECT id_buku FROM peminjaman WHERE id_peminjaman = ?");
    $ambil->bind_param("i", $id_peminjaman);
    $ambil->execute();
    $result = $ambil->get_result();
    $data = $result->fetch_assoc();

    $id_buku = $data['id_buku'];

    // 2. ubah status peminjaman
    $updatePinjam = $koneksi->prepare("
        UPDATE peminjaman 
        SET status = 'dikembalikan' 
        WHERE id_peminjaman = ?
    ");
    $updatePinjam->bind_param("i", $id_peminjaman);
    $updatePinjam->execute();

    // 3. tambah stok buku
    $updateStok = $koneksi->prepare("
        UPDATE buku 
        SET stok = stok + 1,
            status = 'tersedia'
        WHERE id_buku = ?
    ");
    $updateStok->bind_param("i", $id_buku);
    $updateStok->execute();

    $koneksi->commit();
    echo "<script>
        alert('Buku berhasil dikembalikan!');
        window.location='../pengembalian_admin';
    </script>";

} catch (Exception $e) {
    $koneksi->rollback();
    echo "<script>
        alert('Gagal mengembalikan buku!');
        window.location='../peminjaman_admin';
    </script>";
}