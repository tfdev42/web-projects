<?php require_once 'maininclude.inc.php';

    $dba->requireAdmin();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include 'header.inc.php';?>
    <main>
        <h1>Produkte (Admin)</h1>
        <p><a href="admin_create_product.php">Neues Produkt</a></p>

        <?php
            // Lade alle Produkte
        ?>
    </main>
</body>
</html>