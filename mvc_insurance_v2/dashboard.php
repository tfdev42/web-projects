<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once "./includes/config_session.inc.php";
require_once "./includes/dashboard.inc.php";
require_once "./includes/dashboard_view.inc.php";




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <!-- HEADER -->
    <?php isset($_SESSION["user_id"]) ? include "./includes/header.inc.php" : ''; ?>
    <main>
        <div>
         <?php switch_display($_SESSION["display"]); ?>
        </div>
        <div>
            <?php check_session_errors(); ?>
        </div>
    </main>
    
    
</body>
</html>