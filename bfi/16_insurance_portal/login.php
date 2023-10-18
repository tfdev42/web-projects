<?php
require_once 'main.include.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <main>
        <div>
            <form name="login" action="<?php htmlspecialchars($_SESSION['PHP_SELF']);?>" method="post">
                <label for="username">Personennummer</label><br>
                <input name="personennummer" type="text"><br>
                <label for="username">Passwort</label><br>
                <input name="passwort" type="password"><br>
                <button type="submit">Einloggen</button>
            </form>
        </div>
    </main>
</body>
</html>