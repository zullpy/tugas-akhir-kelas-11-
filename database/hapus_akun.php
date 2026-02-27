<?php
include __DIR__ . '/koneksi.php';

$id     = $_GET['id'] ?? null;
$sumber = $_GET['sumber'] ?? null;

if (!$id || !$sumber) {
    die("Data tidak valid");
}

if ($sumber === 'admin') {
    $query = "DELETE FROM admin WHERE id_admin = ?";
} elseif ($sumber === 'user') {
    $query = "DELETE FROM users WHERE id_user = ?";
} else {
    die("Sumber tidak dikenal");
}

$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

/* balik ke halaman akun */
header("Location: ../data_akun/index.php");
exit;