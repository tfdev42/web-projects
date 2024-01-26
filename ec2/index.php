<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

include "./Classes/Controller.class.php";
include "./Classes/View.class.php";

$controller = new Controller();
$currentView = $controller->getCurrentView();
$view = new View();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <main>
        <div>
            <p>
                <?php $view->renderCurrentView($currentView); ?>
            </p>
        </div>
        <div>
            <p>
                <?php $view->renderErrors(); ?>
            </p>
        </div>
    </main>
</body>
</html>