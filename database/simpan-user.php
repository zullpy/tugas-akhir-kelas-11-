<?php
session_start();
include 'koneksi.php';

$nama = $_POST['nama'];
$email = $_POST['email'];
$password = $_POST['password'];

// Hash password untuk keamanan
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Cek apakah email sudah terdaftar
$query_check = "SELECT * FROM users WHERE email=?";
$stmt_check = mysqli_prepare($koneksi, $query_check);
mysqli_stmt_bind_param($stmt_check, "s", $email);
mysqli_stmt_execute($stmt_check);
$result_check = mysqli_stmt_get_result($stmt_check);

if (mysqli_num_rows($result_check) > 0) {
    echo "Email sudah terdaftar!";
} else {
    // Insert user baru
    $query_insert = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt_insert = mysqli_prepare($koneksi, $query_insert);
    mysqli_stmt_bind_param($stmt_insert, "sss", $nama, $email, $hashed_password);
    
    if (mysqli_stmt_execute($stmt_insert)) {
        echo "Registrasi berhasil!";
        $_SESSION['username'] = $nama;
    } else {
        echo "Registrasi gagal: " . mysqli_error($koneksi);
    }
    mysqli_stmt_close($stmt_insert);
}
mysqli_stmt_close($stmt_check);
mysqli_close($koneksi);
?>