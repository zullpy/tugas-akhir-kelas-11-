<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login user</title>
    <link rel="stylesheet" href="login_user/style.css">
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
        <h1>Selamat datang di<br>Halaman User!</h1>
        <p>Anda dapat melihat buku yang dipinjam dan dapat meminjam buku.</p>
        <img src="../asset/buku.webp" alt="buku" class="illustration">
    </div>

    <!-- KANAN -->
    <div class="right">
        <h2>Login</h2>
        <a href="../pemilihan_role" class="back-btn link-slide slide-left">
            <i class="ph ph-arrow-bend-up-right"></i>
        </a>
        <form action="../database/proses_login_user.php" method="post">
            <label>Email</label>
            <input type="text" name="identifier" required>

            <div class="password-wrapper">
                <label>Password</label><input type="password" id="input-password">
                <i class="ph ph-eye" id="togglePassword"></i>
            </div>
            <button type="submit">Login</button>
        </form>
        <a href="../lupa_pass_user" class="link-slide slide-right forget">Lupa password?</a>
    </div>
</div>
</body>
<script src="login_user/script.js"></script>
</html>

<?php if (isset($_GET['success'])): ?>
<script>
alert('Password berhasil diganti, silakan login');
</script>
<?php endif; ?>