<!DOCTYPE html>
<html>
<head>
    <title>Lupa Password</title>
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
        href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/fill/style.css"
    />
</head>
<body>
<a href="../login_user">
    <i class="ph ph-arrow-bend-up-right"></i>
</a>
<h2>Lupa Password</h2>

<form action="../database/proses_lupa.php" method="post">
    <div class="input">
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password_baru" placeholder="Password Baru" required><br><br>
    <input type="password" name="konfirmasi" placeholder="Ulangi Password" required><br><br>
    <button type="submit">Kirim Kode</button>
    </div>
</form>

</body>
</html>