<?php
require_once "./includes/config_session.inc.php";
require_once "./includes/signup.inc.php";
require_once "./includes/signup_view.inc.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    <div>
        <?php displaySignUp(); ?>
    </div>
    <?php
    
    // var_dump($_SESSION["test_val"]);
    // var_dump($_SESSION["signup_role"]);
    ?>
    <div>
        <?php displaySignupErrors(); ?>
    </div>
    <div>
        <?php var_dump($_SESSION["result"]); ?>
    </div>
</body>
</html>