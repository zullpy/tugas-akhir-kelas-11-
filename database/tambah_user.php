<?php
include __DIR__ . '/koneksi.php';

$username = $_POST['username'];
$email    = $_POST['email'];
$password = $_POST['password'];
$kelas    = $_POST['kelas'];
$jurusan  = $_POST['jurusan'];


$query = "INSERT INTO users (username, email, password, kelas, jurusan)
            VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "sssss", $username, $email, $password, $kelas, $jurusan);
mysqli_stmt_execute($stmt);

header("Location: ../data_akun");
exit;
?>