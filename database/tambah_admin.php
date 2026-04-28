<?php
include __DIR__ . '/koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];
$email    = $_POST['email'];


$query = "INSERT INTO admin (username, password, email)
            VALUES (?, ?, ?)";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "sss", $username, $password, $email);
mysqli_stmt_execute($stmt);

header("Location: ../data_akun");
exit;
?>