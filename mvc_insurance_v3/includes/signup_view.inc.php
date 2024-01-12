<?php

function showSignupErrors() {
    if($_SESSION["signup_errors"]){
        $errors = $_SESSION["signup_errors"];
        foreach($errors as $e){
            echo '<p class="error">';
            echo htmlspecialchars($e);
            echo '</p><br>';
        }
        $_SESSION["signup_errors"] = null;
        $errors = null;
    }
}

function displaySignuUp() { ?>
    <form action="./signup_contr.inc.php" method="post">

    </form>
<?php }