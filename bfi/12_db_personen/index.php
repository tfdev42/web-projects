<?php
error_reporting(E_ALL);
ini_set('display_errors','1');
    require_once 'db/dbaccess.inc.php';
    $db = new DbAccess();
    // Lade alle Personen
    // $people ist ein Array mit Obj der Klasse Person
    $people = $db->getPeople();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IndexPHP</title>
</head>
<body>
    <p>
        <a href="create_person.php">Person Anlegen</a>
    </p>
    <?php
        // Ausgabe aller Personen
        // $person ist hier ein einzelnes Obj der Klasse Person
        foreach($people as $person){
            echo '<h2>'.htmlspecialchars($person->name).'</h2>';
            echo '<p>ID: '.htmlspecialchars($person->id).'</p>';
            echo '<p>'.htmlspecialchars('KG: ' . $person->weightKg . ' cm: ' . $person->heightCm) . '</p>';
            echo '<p>BMI: '. htmlspecialchars(number_format($person->bmi(), 2)) . '</p>';
            // Link zur Person-Detailseite generieren
            echo '<a href="person.php?id='.$person->id.'">Details</a>';
        }
    ?>
</body>
</html>