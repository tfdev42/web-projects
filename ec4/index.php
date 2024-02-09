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
    <?php include_once "./inc/header.inc.php"; ?>
    <section><?php $indexContr->renderErrors(); ?></section>
    <!-- <section><?php var_dump($_SESSION["test"]); ?></section> -->
    <main>
        <div>
            <?php $indexContr->renderCurrentView(); ?>
        </div>
    </main>
</body>
</html>