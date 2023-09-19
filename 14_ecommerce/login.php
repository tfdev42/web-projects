<?php
    require_once 'maininclude.inc.php';

    if(isset($_POST['bt_login'])){
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        if(strlen($email) == 0){
            $errors[] = 'Email eingeben!';
        }
        if(strlen($password) == 0){
            $errors[] = 'Passwort eingeben!';
        }
        if(count($errors) == 0){
            // Login probieren!
            $success = $dba->login($email, $password);
            if(!$success){
                $errors[] = 'Email / PW falsch';
            } else {
                // Weiterleitung
                header('Location: index.php');
                exit();
            }
        }
    }


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
            <input type="text" name="email"><br>
            <label>Passwort</label><br>
            <input type="password" name="password"><br>
            <button name="bt_login">Login</button>
        </form>
    </main>
</body>
</html>