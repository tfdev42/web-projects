<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();

include "./Classes/Utils.class.php";
include "./Classes/IndexView.class.php";
include "./Classes/IndexContr.class.php";

$indexContr = new IndexContr();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<?php include "./includes/header.inc.php"; ?>
    <main>
        <section><?php isset($_SESSION["errors"]) ? $indexContr->renderErrors() : ' ' ?></section>
        <div class="main-view">
            <?php $indexContr->renderView(); ?>
        </div>
    </main>
</body>
</html>