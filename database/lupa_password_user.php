<?php
include 'koneksi.php';

$identifier = trim($_POST['identifier']);
$pass_baru  = trim($_POST['password_baru']);
$konfirmasi = trim($_POST['konfirmasi_password']);

if ($pass_baru !== $konfirmasi) {
    header("Location: ../lupa_pass_user/index.php?error=password");
    exit;
}

$query = "SELECT * FROM users WHERE email = ? OR username = ?";
$stmt  = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "ss", $identifier, $identifier);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$user   = mysqli_fetch_assoc($result);

if (!$user) {
    header("Location: ../lupa_pass_user/index.php?error=notfound");
    exit;
}

/* UPDATE PASSWORD */
$update = "UPDATE users SET PASSWORD = ? WHERE id_user = ?";
$stmt2  = mysqli_prepare($koneksi, $update);
mysqli_stmt_bind_param($stmt2, "si", $pass_baru, $user['id_user']);
mysqli_stmt_execute($stmt2);

header("Location: ../login_user/index.php?success=reset");
exit;