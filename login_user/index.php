<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login user</title>
    <link rel="stylesheet" href="login_user/style.css">
</head>
<body>
    <h2>Halaman Login User</h2>
    <form action="../database/proses_login_user.php" method="post">
        <label for="email">Email atau username:</label>
        <input type="text" id="email" name="identifier" required>

        <label for="password">password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">login</button>
    </form>

    <p>
        <a href="../lupa_pass_user" class="link-slide">
                lupa password
        </a>
        <br>
        <a href="../pemilihan_role" class="link-slide">
                kembali ke pemelihan role
        </a>
    </p>
</body>
<script src="login_user/script.js"></script>
</html>

<?php if (isset($_GET['success'])): ?>
<script>
alert('Password berhasil diganti, silakan login');
</script>
<?php endif; ?>