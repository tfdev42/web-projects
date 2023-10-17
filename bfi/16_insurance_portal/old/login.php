<?php
require_once 'main.include.php';
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
    <main>
    <h1>Login</h1>
    <form action="index.php" method="post">
        <label for="personId">PersonID: </label>
        <input type="text" name="personId">

        <label for="password">Password: </label>
        <input type="text" name="password">

        <button type="submit" name="bt_login">Login</button>
    </form>
        
    </main>
</body>
</html>