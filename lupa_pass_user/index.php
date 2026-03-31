
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lupa password</title>
    <link rel="stylesheet" href="lupa_pass_user/style.css">
    <link rel="shortcut icon" href="../asset/favicon.ico" type="image/x-icon">
        <link
        rel="stylesheet"
        type="text/css"
        href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css"
    />
    <link
        rel="stylesheet"
        type="text/css"
        href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css"
    />
</head>
<body>
    <form action="../database/proses_lupa.php" method="POST">
    
    <div class="form-left">
        <h2>Lupa Password?</h2>
        <p>
            Masukkan email atau username Anda dan buat password baru
            untuk mengakses kembali sistem.
        </p>
        <i class="ph-fill ph-book-open" style="font-size:80px;margin-top:20px;"></i>
    </div>
    
    <div class="form-right">
        <div class="back-btn link-slide slide-down">
            <a href="../login_user">
                <i class="ph ph-arrow-bend-up-right"></i>
            </a>
        </div>
        <h3>Reset Password</h3>
        
        <div class="input-group">
            <i class="ph ph-user"></i>
            <input type="text" name="identifier"
                placeholder="Masukkan email atau username" required>
        </div>

        <div class="input-group">
            <i class="ph ph-lock"></i>
            <input type="password" name="password_baru"
                placeholder="Password baru" required>
                <i class="ph ph-eye" id="togglePasswordBaru" style="cursor: pointer;"></i>
            </div>

        <div class="input-group">
            <i class="ph ph-lock-key"></i>
            <input type="password" name="konfirmasi"
                placeholder="Ulangi password" required>
                <i class="ph ph-eye" id="togglePassword" style="cursor: pointer;"></i>
            </div>

        <button type="submit">Ganti Password</button>

    </div>

</form>
</body>
<script src="lupa_pass_user/script.js"></script>
</html>