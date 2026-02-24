<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Buku</title>
    <link rel="stylesheet" href="form_register_user/style.css">
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
    <form action="../database/simpan-user.php" method="post">
        <h2>buat akun baru</h2>
        <label for="nama">Nama Lengkap:</label>
        <input type="text" id="nama" name="nama" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Daftar</button>
        <p class="footer-text">© SMKS SUKAPURA</p>
    </form>
        <p>
        Sudah Memiliki Akun? 
        <a href="../login_user" class="link-slide slide-right">
            Login
        </a>
        <br>
        <a href="../pemilihan_role" class="link-slide slide-left">
            <i class="ph ph-arrow-circle-left"></i>
        </a>
    </p>
</body>
<script src="form_register_user/script.js"></script>
</html>