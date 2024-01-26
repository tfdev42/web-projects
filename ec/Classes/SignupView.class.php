<?php

class SignupView extends User {


    public function showSignupForm() {?>
        <form action="../includes/signup.inc.php" method="post">
            <input type="email" name="email" placeholder="E-Mail">
            <input type="password" name="pwd" placeholder="Password">
            <input type="password" name="pwd_confirm" placeholder="Re-Type Password">
            <button type="submit">Sign Up</button>
        </form>
    <?php }
}