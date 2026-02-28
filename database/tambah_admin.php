<?php
include __DIR__ . '/koneksi.php';

$username = $_POST['username'];
$email    = $_POST['email'];
$password = $_POST['password'];

$query = "INSERT INTO admin (username, email, password)
            VALUES (?, ?, ?)";

$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password);
mysqli_stmt_execute($stmt);

header("Location: ../data_akun");
exit;
?>