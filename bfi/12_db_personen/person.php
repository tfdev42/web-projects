<?php
error_reporting(E_ALL);
ini_set('display_errors','1');
// Zeigt die Daten zur 1 Person an
// --> Detailseite

require_once 'db/dbaccess.inc.php';

$db = new DbAccess();

// fuer welche Person sollen die Daten dargestellt werden?
// --> die ID der Person wird als GET-Parameter in der URL uebertragen
// zBsp: person.php?id=8

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

// soll die Person geloescht werden?
if(isset($_POST['bt_delete_person'])){
    $db->deletePerson($id);
    header('Location: index.php');
    exit();
}



// Person ist da!

if(isset($_POST['bt_delete_person'])){

}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PersonPHP</title>
</head>
<body>
    <h1><?php echo htmlspecialchars(($person->name));?></h1>
    <p>
        <a href="edit.php?id=<?php echo $person->id;?>">Edit</a>
    </p>
    <form action="person.php?id=<?php echo $person->id; ?>" method="POST">
        <button name="bt_delete_person">Loeschen</button>
    </form>
    
</body>
</html>