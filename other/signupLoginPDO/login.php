<?php
require_once "main.inc.php";



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <main>
        <h1>Login</h1>
        <div class="login-area">
            <div class="input-field">
                <label for="email">Email</label>
                <input 
                type="email" 
                name="email" 
                id="email-login">
            </div>
            <div class="input-field">
                <label for="password">Password</label>
                <input type="password" name="password" id="password-login">
            </div>
            <input type="submit" value="Submit">
        </div>
    </main>
    
</body>
</html>