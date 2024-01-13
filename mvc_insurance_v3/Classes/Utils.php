<?php
declare(strict_types=1);

class Utils{
    
    public static function isInputEmpty(array $formData) : array | false{
        $errors = [];
        foreach($formData as $key => $value){
            if (empty($value)){
                // UpperCaseFirstLetter of $key
                $errors[$key] = ucfirst($key) . " is required!";
            }
        }
        return empty($errors) ? false : $errors;
    }

    public static function getPOSTasArray() {
        $post = $_POST;
        $result = [];
        foreach($post as $key => $value){
            if($key === "hidden" || $value === "bt_signup"){
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