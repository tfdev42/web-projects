<?php
require_once "main.inc.php";
require_once "./inc/header.inc.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <main>
        <h1>Welcome</h1>
        <p>
            <?php
            echo "For debugging:";
            echo '<pre>';
            print_r($_SESSION);
            echo '</pre>';
            ?>
        </p>
    </main>
    
</body>
</html>