<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "koneksi.php";

$id = $_GET['id'];

// ambil data peminjaman
$data = mysqli_fetch_assoc(mysqli_query($koneksi, 
    "SELECT * FROM peminjaman WHERE id_peminjaman='$id'"
));

// cek status
if ($data['status'] != 'dipinjam') {
    header("Location: ../peminjaman_admin");
    exit;
}

// ambil harga buku
$buku = mysqli_fetch_assoc(mysqli_query($koneksi, 
    "SELECT harga FROM buku WHERE id_buku='{$data['id_buku']}'"
));

$denda = $buku['harga']; // denda = harga buku


// 2. insert ke transaksi
$query = "
    INSERT INTO transaksi (
        id_user,
        id_buku,
        tanggal_pinjam,
        tanggal_kembali,
        no_wa,
        status,
        denda
    ) VALUES (
        '{$data['id_user']}',
        '{$data['id_buku']}',
        '{$data['tanggal_pinjam']}',
        NOW(),
        '{$data['no_wa']}',
        'hilang',
        '$denda'
    )
";

if (!mysqli_query($koneksi, $query)) {
    die("Error insert: " . mysqli_error($koneksi));
}

// update jadi dihapus di peminjaman
mysqli_query($koneksi, 
    "DELETE FROM peminjaman WHERE id_peminjaman='$id'"
);

header("Location: ../peminjaman_admin");
exit;