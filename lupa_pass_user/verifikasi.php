<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi Kode</title>
    <link rel="stylesheet" href="verifikasi.css">
    <link rel="shortcut icon" href="../asset/favicon.ico" type="image/x-icon">
</head>
<body>

<h2>Masukkan Kode OTP</h2>

<form action="../database/proses_verifikasi.php" method="post">
    
    <div class="otp-container">
        <input type="text" maxlength="1" class="otp-input">
        <input type="text" maxlength="1" class="otp-input">
        <input type="text" maxlength="1" class="otp-input">
        <input type="text" maxlength="1" class="otp-input">
        <input type="text" maxlength="1" class="otp-input">
        <input type="text" maxlength="1" class="otp-input">
    </div>

    <!-- ini yang dikirim ke PHP -->
    <input type="hidden" name="kode" id="kode">

    <br><br>
    <button type="submit">Verifikasi</button>
</form>

</body>
<script src="verifikasi.js"></script>
</html>