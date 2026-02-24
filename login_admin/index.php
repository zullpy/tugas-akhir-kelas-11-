<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="login_admin/style.css">
    <link rel="shortcut icon" href="../asset/favicon.ico" type="image/x-icon">
    <link
        rel="stylesheet"
        type="text/css"
        href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css"
    />
    <link
        rel="stylesheet"
        type="text/css"
        href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/fill/style.css"
    />
</head>
<body>
<div class="login-card" action="">
    <!-- KIRI -->
    <div class="left">
        <h1>Selamat datang di<br>Halaman Admin!</h1>
        <p>Anda dapat mengelola data buku, pengguna, dan laporan inventaris di sini.</p>
        <img src="../asset/buku.webp" alt="buku" class="illustration">
    </div>

    <!-- KANAN -->
    <div class="right">
        <h2>Login</h2>
        <a href="../pemilihan_role" class="back-btn link-slide slide-right">
            <i class="ph ph-arrow-bend-up-right"></i>
        </a>
        <form action="../database/proses_login_admin.php" method="post">
            <label>Email</label>
            <input type="text" name="identifier" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <a href="../lupa_pass_admin" class="link-slide slide-left forget">Lupa password?</a>
    </div>
</div>

</body>
<script src="login_admin/script.js"></script>
</html>

<?php if (isset($_GET['success'])): ?>
<script>
alert('Password berhasil diganti, silakan login');
</script>
<?php endif; ?>