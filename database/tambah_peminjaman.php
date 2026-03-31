<?php
include 'koneksi.php';

$id_user = $_POST['id_user'];
$id_buku = $_POST['id_buku'];
$tgl_pinjam = $_POST['tanggal_pinjam'];
$tgl_kembali = $_POST['tanggal_kembali'];
$no_wa = $_POST['no_wa'];

$koneksi->begin_transaction();

try {
    $cek = $koneksi->prepare("SELECT stok FROM buku WHERE id_buku = ?");
$cek->bind_param("i", $id_buku);
$cek->execute();
$data = $cek->get_result()->fetch_assoc();

if ($data['stok'] <= 0) {
    die("Stok habis!");
}

    // 1. insert ke tabel peminjaman
    $insert = $koneksi->prepare("INSERT INTO peminjaman 
        (id_user, id_buku, tanggal_pinjam, tanggal_kembali, no_wa, status) 
        VALUES (?, ?, ?, ?, ?, 'dipinjam')");
        
    $insert->bind_param("iisss", $id_user, $id_buku, $tgl_pinjam, $tgl_kembali, $no_wa);
    $insert->execute();

    // 🔥 update stok + status sekaligus
$updateBuku = $koneksi->prepare("
    UPDATE buku 
    SET 
        stok = stok - 1,
        status = IF(stok - 1 <= 0, 'dipinjam', 'tersedia')
    WHERE id_buku = ?
");
$updateBuku->bind_param("i", $id_buku);
$updateBuku->execute();

    $koneksi->commit();
    echo "Berhasil pinjam";

} catch (Exception $e) {
    $koneksi->rollback();
    echo "Gagal";
}

$cek = $koneksi->prepare("SELECT stok FROM buku WHERE id_buku = ?");
$cek->bind_param("i", $id_buku);
$cek->execute();
$result = $cek->get_result();
$data = $result->fetch_assoc();

if ($data['stok'] <= 0) {
    echo "Stok habis!";
    exit;
}