<?php
include __DIR__ . '/koneksi.php';

$query = "
    SELECT 
        id_admin AS id,
        username,
        email,
        role,
        'admin' AS sumber
    FROM admin

    UNION ALL

    SELECT 
        id_user AS id,
        username,
        email,
        role,
        'user' AS sumber
    FROM users
";

$result = mysqli_query($koneksi, $query);

if (!$result) {
    die('Query error: ' . mysqli_error($koneksi));
}

/* jumlah akun */
$akun = mysqli_fetch_assoc(
    mysqli_query($koneksi, "
        SELECT COUNT(*) AS total FROM (
            SELECT id_admin AS id FROM admin
            UNION ALL
            SELECT id_user AS id FROM users
        ) AS total_akun
    ")
);

$akun_admin = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM admin")
);

$akun_user = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM users")
);