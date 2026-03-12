<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi Kode</title>
    <link rel="stylesheet" href="verifikasi.css">
    <link rel="shortcut icon" href="../asset/favicon.ico" type="image/x-icon">
</head>
<body>
    <form action="../database/proses_verifikasi.php" method="post">
        <h2>Masukkan Kode OTP</h2>
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

    <div class="warning-box" id="warningBox">
    Kode OTP harus 6 digit!
</div>

<div class="success-box" id="successBox">
    ✔ OTP berhasil diverifikasi.
</div>
</form>

</body>
<script src="verifikasi.js"></script>
</html>