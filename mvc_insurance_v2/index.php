<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once "./includes/config_session.inc.php";
require_once "./includes/login_view.inc.php";
require_once "./includes/signup_view.inc.php";

if($_SERVER["REQUEST_METHOD"] === "POST" 
    && isset($_GET["login"]) 
    && $_GET["login"] === "success"){
    header("Location: ./dashboard.php");
    die();
}

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
        <div class="form-wrapper">
            <h3>Login</h3>

            <form action="./includes/login.inc.php" method="post">
                <input type="text"
                        name="id"
                        placeholder="UserID">
                <input type="password"
                        name="pwd"
                        placeholder="Password">
                <button type="submit" name="bt_login">Login</button>
            </form>
        </div>
        <section><?php check_login_errors(); ?></section>
        <?php if (isset($_GET)) var_dump($_GET);
        ?>
        

        <div class="form-wrapper">
        
            <h3>Signup</h3>
            
            <?php if(!isset($_SESSION["role_signup"])){
                display_signup_role_select();
            } else {
                echo "<h4>You are signing up as " . htmlspecialchars($_SESSION["role_signup"]) . "</h4>";
                display_reset_form();
            } ?>
            <br>
            <?php isset($_SESSION["role_signup"]) ? display_signup_form() : ""; ?>
        </div>

        <section><?php check_signup_errors(); ?></section>
        <!-- <?php var_dump($_SESSION["signup_data"]);  ?>
        <?php var_dump($_SESSION["columns"]);  ?>
        <?php var_dump($_SESSION["placeholders"]);  ?> -->
        



    </main>
</body>
</html>