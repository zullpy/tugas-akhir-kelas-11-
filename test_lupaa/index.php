<!DOCTYPE html>
<html>
<head>
    <title>Lupa Password</title>
</head>
<body>

<h2>Lupa Password</h2>

<form action="../database/proses_lupa.php" method="post">
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password_baru" placeholder="Password Baru" required><br><br>
    <input type="password" name="konfirmasi" placeholder="Ulangi Password" required><br><br>
    <button type="submit">Kirim Kode</button>
</form>

</body>
</html>