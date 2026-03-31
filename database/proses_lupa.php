<?php
session_start();
include "koneksi.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // pakai composer

$email = $_POST['identifier'];
$password_baru = $_POST['password_baru'];
$konfirmasi = $_POST['konfirmasi'];

if ($password_baru != $konfirmasi) {
    die("Password tidak cocok!");
}

$cek = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email'");
$data = mysqli_fetch_assoc($cek);

if (!$data) {
    die("Email tidak ditemukan!");
}

$kode = rand(100000,999999);

mysqli_query($koneksi, "UPDATE users SET 
reset_code='$kode',
reset_expired=DATE_ADD(NOW(), INTERVAL 5 MINUTE)
WHERE email='$email'");

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp-relay.brevo.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'a37fe9001@smtp-brevo.com';
    $mail->Password   = 'WDfvKCXZQdn63FOH';
    $mail->SMTPSecure = 'false';
    $mail->Port       = 587;
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';

    $mail->setFrom('emzul2424@gmail.com', 'Sistem Perpustakaan');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Kode Reset Password Peminjaman Buku';
    $mail->Body    = "<h2>Kode reset password kamu:</h2><h1>$kode</h1>";

    $mail->send();

    $_SESSION['reset_email'] = $email;
    $_SESSION['new_password'] = $password_baru;

    header("Location:../lupa_pass_user/verifikasi.php");
    exit;

} catch (Exception $e) {
    echo "Email gagal dikirim: {$mail->ErrorInfo}";
}
?>