<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once "./Classes/Dbh.class.php";
include_once "./Classes/UserModel.class.php";
include_once "./Classes/IndexController.class.php";
include_once "./Classes/View.class.php";
include_once "./Classes/LoginContr.class.php";
include_once "./Classes/FormValidator.class.php";
include_once "./includes/login.inc.php";


$controller = new IndexController();
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
        <?php $view->renderCurrentView($currentView); ?>            
        </div>
        <div>Errors
        <?php $view->renderErrors(); ?>
        <?php 
        if (isset($_SESSION["errors"])){echo "Yay";};
        // FormValidator::addErrorToArray("test");
        // var_dump(FormValidator::getErrorsArray()); ?>
        </div>
    </main>
</body>
</html>