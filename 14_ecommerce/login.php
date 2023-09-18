<?php
    require_once 'maininclude.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">;
</head>
<body>
    <?php include 'header.inc.php'; ?>
    <main>
        <h1>Login</h1>
        <?php include 'showerrors.inc.php'; ?>
        <form action="login.php" method="post">
            <label>Email</label><br>
            <input type="text" name="email">
            <label>Passwort</label><br>
            <input type="password" name="password"><br>
            <button name="bbt_login">Login</button>
        </form>
    </main>
</body>
</html>