<?php

class Utils {

    /**
     * returns TRUE if user is logged in
     */
    public static function isLoggenIn() {
        return (isset($_SESSION["user_id"]) && ! empty($_SESSION["user_id"]));
    }

    /**
     * returns TRUE if user is admin in
     */
    public static function isAdmin() {
        return (isset($_SESSION["user_role"]) && $_SESSION["user_role"] === "admin");
    }

    /**
     * returns hashed pwd
     */
    public static function hashPwd($pwd) {
        return password_hash($pwd, PASSWORD_DEFAULT);
    }


    /**
     * returns TRUE if input pwd is same as pwd saved in DB
     */
    public static function verifyPwd($pwd, $hashedPwd) {
        return password_verify($pwd, $hashedPwd);
    }


    public static function showLoginButton() { ?>
        <form action="../includes/login.inc.php" method="post">
            <button type="submit">Login</button>
        </form>        
    <?php }


    public static function showSignupButton() { ?>
        <form action="../includes/signup.inc.php" method="post">
            <button type="submit">Signup</button>
        </form>        
    <?php }

    public static function showLogoutButton() { ?>
        <form action="../includes/logout.inc.php" method="post">
            <button type="submit">Signup</button>
        </form>        
    <?php }





}