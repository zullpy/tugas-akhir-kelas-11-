<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'koneksi.php';
session_start();

// ambil data
$id_user = $_POST['id_user'];
$id_buku = $_POST['id_buku'];
$tgl_pinjam = $_POST['tanggal_pinjam'];
$tgl_kembali = $_POST['tanggal_kembali'];
$no_wa = $_POST['no_wa'];

// validasi kosong
if (empty($id_user) || empty($id_buku) || empty($tgl_pinjam) || empty($tgl_kembali)) {
    die("<script>alert('Data tidak lengkap!');history.back();</script>");
}

// validasi tanggal
$pinjam = new DateTime($tgl_pinjam);
$kembali = new DateTime($tgl_kembali);

// max 7 hari
$max_kembali = clone $pinjam;
$max_kembali->modify('+7 days');

// kembali sebelum pinjam
if ($kembali < $pinjam) {
    die("<script>alert('Tanggal kembali tidak valid!');history.back();</script>");
}

//lebih dari 7 hari
if ($kembali > $max_kembali) {
    die("<script>alert('Maksimal peminjaman hanya 7 hari!');history.back();</script>");
}

// redirect berdasarkan role
$redirect = ($_SESSION['role'] == 'admin') 
    ? '../peminjaman_admin' 
    : '../peminjaman_user';

// mulai transaksi
$koneksi->begin_transaction();

try {

    // cek stok dulu
    $cek = $koneksi->prepare("SELECT stok FROM buku WHERE id_buku = ?");
    $cek->bind_param("i", $id_buku);
    $cek->execute();
    $data = $cek->get_result()->fetch_assoc();

    if (!$data) {
        throw new Exception("Buku tidak ditemukan!");
    }

    if ($data['stok'] <= 0) {
        throw new Exception("Stok habis!");
    }

    // insert peminjaman
    $insert = $koneksi->prepare("
        INSERT INTO peminjaman 
        (id_user, id_buku, tanggal_pinjam, tanggal_kembali, no_wa, status) 
        VALUES (?, ?, ?, ?, ?, 'dipinjam')
    ");
    $insert->bind_param("iisss", $id_user, $id_buku, $tgl_pinjam, $tgl_kembali, $no_wa);

    if (!$insert->execute()) {
        throw new Exception($insert->error);
    }

    // kurangi stok
    $updateStok = $koneksi->prepare("
        UPDATE buku 
        SET stok = stok - 1 
        WHERE id_buku = ?
    ");
    $updateStok->bind_param("i", $id_buku);

    if (!$updateStok->execute()) {
        throw new Exception($updateStok->error);
    }

    // ambil stok terbaru
    $cek2 = $koneksi->prepare("SELECT stok FROM buku WHERE id_buku = ?");
    $cek2->bind_param("i", $id_buku);
    $cek2->execute();
    $stokBaru = $cek2->get_result()->fetch_assoc()['stok'];

    // update status sesuai stok
    $status = ($stokBaru <= 0) ? 'dipinjam' : 'tersedia';

    $updateStatus = $koneksi->prepare("
        UPDATE buku 
        SET status = ?
        WHERE id_buku = ?
    ");
    $updateStatus->bind_param("si", $status, $id_buku);

    if (!$updateStatus->execute()) {
        throw new Exception($updateStatus->error);
    }

    // commit
    $koneksi->commit();

    echo "<script>
        alert('Peminjaman berhasil!');
        window.location='$redirect';
    </script>";

} catch (Exception $e) {

    $koneksi->rollback();

    echo "<script>
        alert('Gagal: ".$e->getMessage()."');
        window.location='$redirect';
    </script>";
}
?>