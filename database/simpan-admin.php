<?php
session_start();
include 'koneksi.php';

$nama = $_POST['nama'];
$email = $_POST['email'];
$password = $_POST['password'];

// cek email 
$query_check = "SELECT * FROM admin WHERE email=?";
$stmt_check = mysqli_prepare($koneksi, $query_check);
mysqli_stmt_bind_param($stmt_check, "s", $email);
mysqli_stmt_execute($stmt_check);
$result_check = mysqli_stmt_get_result($stmt_check);

if (mysqli_num_rows($result_check) > 0) {
    echo "Email sudah terdaftar!";
} else {
    // memasukan ke database
    $query_insert = "INSERT INTO admin (username, email, password) VALUES (?, ?, ?)";
    $stmt_insert = mysqli_prepare($koneksi, $query_insert);
    mysqli_stmt_bind_param($stmt_insert, "sss", $nama, $email, $password);
    
    if (mysqli_stmt_execute($stmt_insert)) {
        echo "<script>alert('Registrasi berhasil! Silahkan login.'); window.location.href = '../form_register_admin/index.html';</script>";
        $_SESSION['username'] = $nama;
    } else {
        echo "Registrasi gagal: " . mysqli_error($koneksi);
    }
    mysqli_stmt_close($stmt_insert);
}
mysqli_stmt_close($stmt_check);
mysqli_close($koneksi);
?>
