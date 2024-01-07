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
    <?php isset($_SESSION["user_id"]) ? include "./header.php" : ''; ?>
    <main>
        <h3>Welcome to the <?php echo htmlspecialchars($_SESSION["user_role"]); ?> Dashboard</h3>
        <?php var_dump($_SESSION["user_id"]) ?>
        <?php var_dump($userId) ?>
        <?php var_dump($_SESSION["user"]) ?>
        <p><?php var_dump($_SESSION["user_role"]) ?></p>
        <p><?php var_dump($_SESSION["user_permissions"]) ?></p>
    </main>
    
    
</body>
</html>