<?php
// Session starten damit Login funktioniert!!
session_start();
require_once 'db/dbaccess.inc.php';
$db = new DbAccess();

// Seite darf nur aufgerufen werden wenn User angemeldet ist
$db->requireLoggedIn();

// Aktuellen User laden
$user = $db->getUserById($_SESSION['user_id']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>
    <p>Nur wer angemeldet ist sieht diese Seite.</p>
    <p>
        <?php echo print_r($user); ?>
    </p>
</body>
</html>