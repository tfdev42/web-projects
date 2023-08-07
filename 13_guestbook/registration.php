<?php
    error_reporting(E_ALL);
    ini_set('display_errors','1');
    require_once 'db/dbaccess.inc.php';
    $db = new DbAccess();


    // Array fuer FMs
    $errors = [];


    // Formular abgesendet
    if(isset($_POST['bt_register'])){
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $name = trim($_POST['name']);
        $birthdate = trim($_POST['birthdate']);

        // Newsletter
        $newsletter = false;
        if(isset($_POST['newsletter'])){
            $newsletter = true;
        };
        // $newsletter = isset($_POST['newsletter']);

        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
            $errors[] = 'Emmail ist ungueltig!';
        };


        // validate Birthdate
        $birthdateDateTime = DateTime::createFromFormat('d.m.Y', $birthdate); // false wenn nicht funktioniert
        if(!$birthdateDateTime){
            $errors[] = 'Geburtsdatum ist ungueltig!';
        };

        // PW Laenge
        if(strlen($password) < 6){
            $errors[] = 'PW muss aus mindestens 6 Zeichen bestehen!';
        };

        if(strlen($name) == 0){
            $errors[] = 'Name eingeben!';
        };

        // wenn keine FMs sind --> registrierung durchfuehren
        if(count($errors) == 0){
            $db->register($email, $password, $name, $birthdateDateTime, $newsletter);
            echo 'OK!';
        };



    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
    <h1>Registrierung</h1>
    <?php
        // Ausgabe der FMs
        if(count($errors) > 0){
            echo '<ul>';
            foreach($errors as $error){
                echo '<li>' . htmlspecialchars($error) . '</li>';
            }
            echo '</ul>';
        }
    ?>
    <form action="registration.php" method="POST">
        <label>Email:</label><br>
        <input type="text" name="email"><br>
        <label>Password:</label><br>
        <input type="password" name="password"><br>
        <label>Name:</label><br>
        <input type="text" name="name"><br>
        <label>Geburtsdatum (TT.MM.JJJJ)</label><br>
        <input type="text" name="birthdate"><br>
        <input type="checkbox" name="newsletter">
        <label>Newsletter abonnieren</label><br>
        <button type="submit" name="bt_register">Registrieren</button>
    </form>
</body>
</html>