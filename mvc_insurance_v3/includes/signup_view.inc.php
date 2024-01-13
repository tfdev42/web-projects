<?php

function showSignupErrors() {
    if(isset($_SESSION["signup_errors"])){
        $errors = $_SESSION["signup_errors"];
        foreach($errors as $e){
            echo '<p class="error">';
            echo htmlspecialchars($e);
            echo '</p><br>';
        }
        unset($_SESSION["signup_errors"]);
        $errors = null;
    }
}

function displayRoleSelect() { ?>
    <form action="../index.php" method="post">
        <h5>Sign up as: </h5>
        <input type="button" value="Customer">
        <input type="button" value="Agent">
        <input type="button" value="Manager">
    </form>
<?php }

function displaySignuUp() { ?>
    <form action="./signup_contr.inc.php" method="post">

    </form>
<?php }