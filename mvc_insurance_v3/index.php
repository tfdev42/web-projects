<?php
session_start();
require_once "./includes/signup_view.inc.php";
require_once "./includes/signup_contr.inc.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insurance</title>
</head>
<body>
    <main>
        <div class="form-wrapper">
            <div>
                <h3>Login</h3>
            </div>
        </div>
        <div class="form-wrapper">
            <div>
                <h3>Signup</h3>
                <?php if ( !isset($_SESSION["signup_role"]) && empty($_SESSION["signup_role"])){
                    displayRoleSelect();
                } else {
                    
                } ?>
            </div>
        </div>
    </main>
</body>
</html>