<?php
// Session starten damit Login funktioniert!!
session_start();
require_once 'db/dbaccess.inc.php';
$db = new DbAccess();

// User muss angemeldet sein um die Seite aufrufen zu können
$db->requireLoggedIn();

// Logout-Button gedrückt?
if(isset($_POST['bt_logout']))
{
    $db->logout();
    header('Location: login.php');
    exit();
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
    <form action="logout.php" method="POST">
        <button name="bt_logout">Logout</button>
    </form>
</body>
</html>