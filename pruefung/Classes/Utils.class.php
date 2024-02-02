<?php

class Utils {

    public static function isCustomerLoggedIn() {
        return isset($_SESSION["user"]["id"]) 
            && isset($_SESSION["user"]["role"])
            && $_SESSION["user"]["role"] === "customer";
    }

    public static function isAgentLoggedIn() {
        return isset($_SESSION["user"]["id"]) 
            && isset($_SESSION["user"]["role"])
            && $_SESSION["user"]["role"] === "agent";
    }

    /**
     * returns True if input empty
     */
    public static function isInputEmpty($input) {
        
        return empty($input);
    }
}