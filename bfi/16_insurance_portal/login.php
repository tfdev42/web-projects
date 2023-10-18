<?php
require_once 'main.include.php';


//if($_SERVER)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main>
        <div>
            <form name="login" action="index.php" method="post">
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