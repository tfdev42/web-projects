<?php
// Session starten damit Login funktioniert!!
session_start();
require_once 'db/dbaccess.inc.php';
$db = new DbAccess();

// Array für Fehlermeldungen
$errors = [];

// Formular abgesendet?
if(isset($_POST['bt_register']))
{
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $name = trim($_POST['name']);
    $birthdate = trim($_POST['birthdate']);

    // Newsletter (checkbox auswerten)
    $newsletter = false;
    if(isset($_POST['newsletter'])){
        $newsletter = true;
    }
    // Alternative zu den 4 vorhergehenden Zeilen in einer Zeile:
    // $newsletter = isset($_POST['newsletter']);

    // hat eingegebene Email die korrekte Syntax?
    if(filter_var($email, FILTER_VALIDATE_EMAIL) == false)
    {
        $errors[] = 'Email ist ungültig!';
    }

    // DateTime::createFromFormat erzeugt aus dem eingegebenen String 
    // ein Objekt der Klasse DateTime. Liefert jedoch false zurück 
    // wenn der eingegebene String nicht in ein DateTime-Objekt konvertiert werden konnte.
    // z. B. wenn das Datum im falschen Format eingegeben wurde. 
    $birthdateDateTime = DateTime::createFromFormat('d.m.Y', $birthdate);
    if($birthdateDateTime == false){
        $errors[] = 'Geburtsdatum ist ungültig!';
    }

    if(strlen($password) < 6){
        $errors[] = 'Das Passwort muss aus mind. 6 Zeichen bestehen!';
    }
    if(strlen($name) == 0){
        $errors[] = 'Name eingeben!';
    }

    // Wenn keine Fehler aufgetreten sind --> Registrierung durchführen!
    if(count($errors) == 0)
    {
        $db->register($email, $password, $name, $birthdateDateTime, $newsletter);
        echo 'OK!';
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
    <h1>Registrierung</h1>
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
    <form action="registration.php" method="POST">
        <label>Email:</label><br>
        <input type="text" name="email"><br>
        <label>Passwort:</label><br>
        <input type="password" name="password"><br>
        <label>Name:</label><br>
        <input type="text" name="name"><br>
        <label>Geburtsdatum (TT.MM.JJJJ):</label><br>
        <input type="text" name="birthdate"><br>
        <input type="checkbox" name="newsletter">
        <label>Newsletter abonnieren</label><br>
        <button name="bt_register">Registrieren</button>
    </form>
</body>
</html>