<?php
declare(strict_types=1);

class Utils{
    
    public static function getPostInputFields() : array | null {
        $post = $_POST;
        $result = [];
        foreach($post as $key => $value){
            // if HTML <input type=hidden> || Post value starts with any bt_ for Buttons -> dont add to array
            if($key === "bt_signup"){
                continue;
            }
            $result[$key] = $value;
        }
        return $result;
    }

    public static function isLoggedIn() : bool {
        // if the user_id is already set
        if (isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"])){
            return true;
        } else return false;
    }

    public static function getSignupRole() : string | null {
        // if _SESSION["signup_role"] not empty, return _SESSION["signup_role"] else NULL
        return !empty($_SESSION["signup_role"]) ?? $_SESSION["signup_role"];
    }
}