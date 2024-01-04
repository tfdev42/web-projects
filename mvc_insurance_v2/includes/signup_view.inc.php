<?php
declare(strict_types=1);


function check_signup_errors() {
    if(isset($_SESSION["errors_signup"])){
        $errors = $_SESSION["errors_signup"];
        foreach ($errors as $error){
            echo '<p class="form-error">';
            echo htmlspecialchars($error);
            echo '</p><br>';
        }
    }
    unset($_SESSION["errors_signup"]);
}

function display_reset_form(){ ?>
    <form action="index.php" method="post">
        <button type="submit" name="bt_reset">Reset</button>
    </form> <?php
    if(isset($_POST["bt_reset"])){
        unset($_SESSION["role_signup"]);
        unset($_SESSION["signup_data"]);
        header("Location: index.php");
        exit();
    }
    
}

function display_signup_role_select(){ ?>
    <form action="./includes/signup.inc.php" method="post">
        Signup as ...
        <input type="submit" name="role" value="customer" class="role_button">
        <input type="submit" name="role" value="manager" class="role_button">
        <input type="submit" name="role" value="agent" class="role_button">
    </form>
<?php }


function display_signup_form() { ?>
    <form action="./includes/signup.inc.php" method="post">
        <input type="text" name="fname" placeholder="Firstname">
        <input type="text" name="lname" placeholder="Lastname">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="pwd" placeholder="Password">
        <input type="text" name="street" placeholder="Street">
        <input type="text" name="city" placeholder="City">
        <input type="text" name="country" placeholder="Country">
        <input type="text" name="zip" placeholder="ZIP">
        <?php $_SESSION["role_signup"] == "customer" ? display_payment_method() : ""; ?>
        <br>
        <button type="submit" name="bt_signup">Signup</button>
    </form>
<?php }

function display_payment_method() {
    // <!-- Display payment option field only for customers -->
    ?> <label>
        Payment Option:
        <select name="payment_option">
            <option value="1">Bill</option>
            <option value="2">IBAN</option>
        </select>
    </label>
    <input type="text" name="iban" placeholder="IBAN">
<?php }