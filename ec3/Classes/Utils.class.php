<?php

class Utils {

    public static function isCustomerLoggedIn() {
        return isset($_SESSION["user"]["id"]) 
            && isset($_SESSION["user"]["role"])
            && $_SESSION["user"]["role"] === "customer";
    }

    public static function isAdminLoggedIn() {
        return isset($_SESSION["user"]["id"]) 
            && isset($_SESSION["user"]["role"])
            && $_SESSION["user"]["role"] === "admin";
    }
}