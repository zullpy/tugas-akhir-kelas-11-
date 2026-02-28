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
<div class="login-card">

    <div class="left">
        <h2>Selamat datang!</h2>
        <p>Buat akun untuk mulai menggunakan sistem peminjaman buku.</p>
        <img src="../asset/buku2.png" class="illustration">
    </div>

    <div class="right">
    <form action="../database/simpan-user.php" method="post">
        <a href="./" class="back-btn link-slide slide-left">
            <i class="ph ph-arrow-bend-up-right"></i>
        </a>
        <h3>Register</h3>
        <input placeholder="Nama Lengkap" id="nama" name="nama" required>
        <div class="pilihan">
            <select name="kelas" id="kelas" >
                <option value="" disabled selected>Pilih Kelas</option>
                <option value="X" >X</option>
                <option value="XI" >XI</option>
                <option value="XII" >XII</option>
            </select>
            <select name="jurusan" id="jurusan" >
                <option value="" disabled selected>Pilih Jurusan</option>
                <option value="PPLG" >PPLG</option>
                <option value="MP" >MP</option>
                <option value="TKJ" >TKJ</option>
                <option value="DKV" >DKV</option>
                <option value="BD" >BD</option>
                <option value="TBSM" >TBSM</option>
                <option value="KULINER" >KULINER</option>
                <option value="TATA BUSANA" >TATA BUSANA</option>
                <option value="AKUNTANSI" >AKUNTANSI</option>
            </select>
        </div>
        <input placeholder="Email" id="email" name="email" type="email" required>
        <div class="password-wrapper">
            <input type="password" placeholder="Password" id="input-password" name="password" required>
            <span class="toggle-password" >
                <i class="ph ph-eye" id="togglePassword"></i>
            </span>
        </div>
        <button type="submit">Daftar</button>
        <p class="login-link ">
            Sudah punya akun? <a href="../login_user" class="link-slide slide-up">Login</a>
        </p>
    </form>

</div>

</body>
<script src="form_register_user/script.js"></script>
</html>