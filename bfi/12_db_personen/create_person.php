
<?php
    error_reporting(E_ALL);
    ini_set('display_errors','1');


    require_once 'db/dbaccess.inc.php';
    // erzeuge ein Obj der class DbAccess
    $db = new DbAccess();

    if(isset($_POST['bt_create_person'])){
        $name = trim($_POST['name']);
        $heightCm = trim($_POST['heightCm']);
        $weightKg = trim($_POST['weightKg']);

        // TODO Formularvalidierung

        $id = $db->createPerson($name, $heightCm, $weightKg);
        // Redirect von POST -> GET
        // um ein versehetliches doppeltes Absenden des Formular
        // zu verhindern
        //echo "<p>Person mit der ID $id wurde gespeichert.</p>";

        // der browser laedt mit einer GET-Request die Datei index.php
        header('Location: index.php');
        // falls der Redirect zu langsam ist
        // alles nach exit() passiert nicht mehr
        exit();
    }

    

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Person Anlegen</title>
</head>
<body>
    <h1>Person Anlegen</h1>
    <form action="create_person.php" method="POST">
        <label>Name: </label><br>
        <input type="text" name="name"><br>

        <label>Koerpergroesse: </label><br>
        <input type="text" name="heightCm"><br>

        <label>Gewicht: </label><br>
        <input type="text" name="weightKg"><br>

        <button name="bt_create_person">Speichern</button>
    </form>
</body>
</html>