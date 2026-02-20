<?php
session_start();
include 'koneksi.php';

$identifier = $_POST['identifier'];
$PASSWORD = $_POST['password'];

// Ambil data user berdasarkan email atau username
$query = "SELECT * FROM admin WHERE email=? OR username=?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "ss", $identifier, $identifier);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if ($user) {
    // Cek password

    if ($PASSWORD === $user['PASSWORD']) {
        $_SESSION['id_admin'] = $user['id_admin'];
        $_SESSION['username'] = $user['username'];

        echo "<script>
        alert('login berhasil!'); window.location.href = '../dashboard_admin/index.php';
        </script>";
        exit;
        // header("Location: dashboard.php");
    } else {
        echo "<script>
        alert('Password salah!'); window.location.href = '../login_admin/index.php';
        </script>";
        exit;
    }
} else {
    echo "<script>
    alert('Email tidak ditemukan!'); window.location.href = '../login_admin/index.php';
    </script>";
    exit;
    }


?>
