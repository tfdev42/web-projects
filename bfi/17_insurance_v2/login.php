<?php 
require_once 'maininclude.inc.php';

// Diese Seite darf nur aufgerufen werden wenn
// man noch NICHT angemeldet ist.
$dba->requireNotLoggedIn();

if(isset($_POST['bt_login']))
{
    $id = trim($_POST['id']);
    $password = trim($_POST['password']);
    if(strlen($id) == 0){
        $errors[] = 'Personennummer eingeben!';
    }
    if(strlen($password) == 0){
        $errors[] = 'Passwort eingeben!';
    }
    if(count($errors) == 0){
        // Login probieren!
        $success = $dba->login($id, $password);
        if(!$success){
            $errors[] = 'Personennummer / Passwort falsch';
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
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.inc.php'; ?>
    <main>
        <h1>Login</h1>
        <?php 
        if(isset($_GET['userid'])){
            echo '<p><strong>Melden Sie sich mit Ihrer Personennummer an: '.htmlspecialchars($_GET['userid']).'</strong></p>';
        }
        ?>
        <?php include 'showerrors.inc.php'; ?>
        <form action="login.php" method="POST">
            <label>Personennummer</label><br>
            <input type="text" name="id"><br>
            <label>Passwort</label><br>
            <input type="password" name="password"><br>
            <button name="bt_login">Login</button>
        </form>
    </main>
</body>
</html>