<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi Kode</title>
</head>
<body>

<h2>Masukkan Kode OTP</h2>

<form action="../database/proses_verifikasi.php" method="post">
    <input type="text" name="kode" placeholder="Masukkan kode" required><br><br>
    <button type="submit">Verifikasi</button>
</form>

</body>
</html>