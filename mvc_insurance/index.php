<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once "./includes/config_session.inc.php";
// require_once "./includes/signup.inc.php";
require_once "./includes/signup_view.inc.php";

?>


<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insurance Home</title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css"> -->
</head>
<body>
    <main>
        <div class="form-wrapper">
            <h3>Login</h3>

            <form action="./includes/login.inc.php" method="post">
                <label for="login_userid">UserID</label>
                <input type="text"
                        id="login_userid"
                        name="userid"
                        placeholder="UserID">
                <label for="login_pwd">Password</label>
                <input type="password"
                        name="pwd"
                        placeholder="Password"
                        id="login_pwd">

                <button type="submit" name="bt_login">Login</button>

            </form>
        </div>
        
        

        <div class="form-wrapper">
            <h3>Signup</h3>

            <?php if(!isset($_SESSION["role_signup"])){
                display_role_select();
            } else {
                echo "<h4>You are signing up as " . htmlspecialchars($_SESSION["role_signup"]) . "</h4><br>";
                display_reset_form();
            } ?><br>
            <?php isset($_SESSION["role_signup"]) ? display_signup_form() : ""; ?>
        </div>
        <br>
        <?php check_signup_errors(); 
        var_dump($_SESSION["errors_signup"]);?>
        
        
        

        
    </main>
    
</body>
</html>