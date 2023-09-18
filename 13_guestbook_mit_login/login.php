<?php
// Session starten damit Login funktioniert!!
session_start();
require_once 'db/dbaccess.inc.php';
$db = new DbAccess();

// Array für Fehlermeldungen
$errors = [];

// Formular abgesendet?
if(isset($_POST['bt_login']))
{
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    if(strlen($email) == 0){
        $errors[] = 'Bitte die E-Mail Adresse eingeben!';
    }
    if(strlen($password) == 0){
        $errors[] = 'Bitte das Passwort eingeben!';
    }

    // Wenn keine Fehler aufgetreten sind --> Registrierung durchführen!
    if(count($errors) == 0)
    {
        $success = $db->login($email, $password);
        if($success == true){
            header('Location: dashboard.php');
            exit();
        } else {
            $errors[] = 'Email oder Passwort falsch!';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Login</h1>
    <?php
    // Ausgabe der Fehlermeldungen
    if(count($errors) > 0)
    {
        echo '<ul>';
        foreach($errors as $error)
        {
            echo '<li>' . htmlspecialchars($error) . '</li>';
        }
        echo '</ul>';
    }
    ?>
    <form action="login.php" method="POST">
        <label>Email:</label><br>
        <input type="text" name="email"><br>
        <label>Passwort:</label><br>
        <input type="password" name="password"><br>
        <button name="bt_login">Login</button>
    </form>
</body>
</html>