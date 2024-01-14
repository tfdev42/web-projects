<?php

function displaySignupErrors() {
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

function displayRoleSelect() { 
    if ( ! $_SESSION["signup_role"]) {?>
        <form action="../index.php" method="post">
            <label for="signup_role">Signup as: </label>
            <input type="submit" name="signup_role" value="Customer">
            <input type="submit" name="signup_role" value="Agent">
            <input type="submit" name="signup_role" value="Manager">
        </form>

    <?php }
    else {
        echo '<p>You are signing up as <strong><i>' . htmlspecialchars($_SESSION["signup_role"]) . '</i></strong></p>';
        displayResetForm();
        echo '<br>';
    }
}

function displaySignUp() {
    echo '<h3>Sign Up</h3>';
    displayRoleSelect(); ?>
    <form action="./signup.inc.php" method="post">
        <input type="text" name="firstname" placeholder="Firstname">
        <input type="text" name="lastname" placeholder="Lastname">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="pwd" placeholder="Password">
        <input type="text" name="street" placeholder="Street">
        <input type="text" name="city" placeholder="City">
        <input type="text" name="country" placeholder="Country">
        <input type="text" name="zip" placeholder="ZIP">
        <?php displayPaymentMethod() ?>
        <br>
        <button type="submit" name="bt_signup">Signup</button>
    </form>
<?php }

function displayPaymentMethod() {
    // <!-- Display payment option field only for customers -->
    if ($_SESSION["signup_role"] === "Customer"){
        ?> <label>
            Payment Option:
            <select name="payment_option_id">
                <option value="1">Bill</option>
                <option value="2">IBAN</option>
            </select>
        </label>
        <input type="text" name="iban" placeholder="IBAN">
<?php }
}

function displayResetForm(){ ?>
    <form action="../index.php" method="post">
        <button type="submit" name="bt_reset">Reset</button>
    </form> <?php
    if(isset($_POST["bt_reset"])){
        unset($_SESSION["signup_role"]);
        unset($_SESSION["signup_data"]);
        header("Location: ../index.php");
        exit();
    }    
}