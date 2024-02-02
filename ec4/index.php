<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
include_once "./inc/autoloader.php";

$indexContr = new IndexContr();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    <main>
        <div>
            <?php $indexContr->renderCurrentView(); ?>
        </div>
    </main>
</body>
</html>