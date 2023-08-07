<?php
error_reporting(E_ALL);
ini_set('display_errors','1');

require_once 'db/dbaccess.inc.php';
$db = new DbAccess();

// wenn es NICHT den GET-Parameter id gibt --> Fehler
if(empty($_GET['id'])){
    exit('Get-Parameter ID fehlt!');
}

// die ID nach der gesucht werden soll
$id = trim($_GET['id']);

// Lade die Person anhand der ID in $id
$person = $db->getPersonById($id);

// wurde eine Person gefunden
//if($person == false){}
if(!$person){
    exit('Person nicht gefunden!');
}

// Person ist da!

if(isset($_POST['bt_edit_person'])){
    $name = trim($_POST['name']);
    $heightCm = trim($_POST['heightCm']);
    $weightKg = trim($_POST['weightKg']);

    // TODO: Formularvalidierung

    // Aenderungen speichern
    // aktualisiere Daten im Obj
    $person->name = $name;
    $person->weightKg = $weightKg;
    $person->heightCm = $heightCm;

    $db->updatePerson($person);

    // 
    header("Location: person.php?id=$id");
    exit();
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bearbeiten</title>
</head>
<body>
    <form action="edit.php?id=<?php echo $person->id; ?>" method="POST">
        <label>Name: </label><br>
        <input type="text" name="name" value="<?php echo $person->name; ?>"><br>

        <label>Koerpergroesse: </label><br>
        <input type="text" name="heightCm" value="<?php echo $person->heightCm; ?>"><br>

        <label>Gewicht: </label><br>
        <input type="text" name="weightKg" value="<?php echo $person->weightKg; ?>"><br>

        <button name="bt_edit_person">Speichern</button>
    </form>
    
</body>
</html>