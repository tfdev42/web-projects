<?php

    error_reporting(E_ALL);

    ini_set('display_errors','1');

    if(isset($_GET(['submit']))){
        $pw_length = (int) $_GET(['passwordlaenge']);
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Generator</title>
</head>
<body>
    <form action="password_generator.php" method="get">
        <label for="characters">Passwortlaenge</label><br>
        <input type="text" id="passwortlaenge" name="passwortlaenge"><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>