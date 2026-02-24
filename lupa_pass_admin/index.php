<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lupa password</title>
    <link rel="stylesheet" href="lupa_pass/style.css">
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
    <form action="../database/lupa_password_admin.php" method="POST">
        <input type="text" name="identifier" placeholder="Masukkan email atau username" required>
        <input type="password" name="password_baru" placeholder="Password baru" required>
        <input type="password" name="konfirmasi_password" placeholder="Ulangi password" required>
        <button type="submit">Ganti Password</button>
    </form>
</body>
<script src="lupa_pass/script.js"></script>
</html>

<?php if (isset($_GET['error'])): ?>
<script>
<?php if ($_GET['error'] === 'PASSWORD'): ?>
    alert('Password tidak sama');
<?php elseif ($_GET['error'] === 'email'): ?>
    alert('Email tidak ditemukan');
<?php endif; ?>
</script>
<?php endif; ?>