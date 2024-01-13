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
    <form action="/opt/lampp/htdocs/web-projects/mvc_insurance_v3/index.php" method="post">
        <h5>Sign up as: </h5>
        <input type="submit" name="signup_role" value="Customer">
        <input type="submit" name="signup_role" value="Agent">
        <input type="submit" name="signup_role" value="Manager">
    </form>
<?php }

function displaySignUp() { ?>
    <form action="./signup_contr.inc.php" method="post">
        <input type="text" name="firstname" placeholder="Firstname">
        <input type="text" name="lastname" placeholder="Lastname">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="pwd" placeholder="Password">
        <input type="text" name="street" placeholder="Street">
        <input type="text" name="city" placeholder="City">
        <input type="text" name="country" placeholder="Country">
        <input type="text" name="zip" placeholder="ZIP">
        <?php $_SESSION["signup_role"] == "customer" ? display_payment_method() : ""; ?>
        <br>
        <button type="submit" name="bt_signup">Signup</button>
    </form>
<?php }

function displaySignupRoleResetBtn() { ?>
    <form action="./index.php" method="post">
        <input type="button" name="bt_role_reset" value="Reset">
    </form>
<?php }