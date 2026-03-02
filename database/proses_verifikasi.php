<?php
session_start();
include "koneksi.php";

$email = $_SESSION['reset_email'];
$password_hash = $_SESSION['new_password'];
$kode = $_POST['kode'];

$query = mysqli_query($koneksi,
    "SELECT * FROM users 
    WHERE email='$email' 
    AND reset_code='$kode'
    AND reset_expired > NOW()");

$data = mysqli_fetch_assoc($query);

if ($data) {

    mysqli_query($koneksi, "UPDATE users SET 
    password='$password_hash',
    reset_code=NULL,
    reset_expired=NULL
    WHERE email='$email'");

    session_destroy();

    echo "<script>alert('Password berhasil diganti! Silakan login.'); window.location.href = '../login_user';</script>";

} else {
    echo "<script>alert('Kode OTP salah atau sudah expired!'); window.location.href = '../lupa_pass_user/verifikasi.php';</script>";
}
?>