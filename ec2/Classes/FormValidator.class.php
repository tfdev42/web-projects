<?php

class FormValidator {

    private static $inputData = [];

    public static function setInputData($postArray){
        self::$inputData = $postArray;
    }
    
    public static function isAnyInputEmpty() {
        return empty(self::$inputData);
    }

    /**
     * single field inputEmpty Test
     */
    public static function isInputEmptyField($inputField) {
        return empty($inputField);
    }

    /**
     * returns TRUE if Email Invalid
     */
    public static function isEmailInvalid() {
        return filter_var(self::$inputData["email"], FILTER_VALIDATE_EMAIL) === false;
    }

    /**
     * returns TRUE if pwd length < 13
     */
    public static function isPwdNOTLongEnough(){
        return strlen(self::$inputData["pwd"]) < 8;
    }

    /**
     * returns TRUE if pwd doesn't contain 
     * 1 capital letter + 1 number + special char in $pattern
     */
    public static function isPwdNOTComplexEnough(){

        $pattern = '/[!@#$%^&*()_+{}\[\]:;<>,.?~\\\-]/';

        return preg_match($pattern, self::$inputData["pwd"]) === 0;
    }

    /**
     * returns TRUE if Pwd !== Repeat Pwd
     */
    public static function pwdDoesntMatchRepeatPwd() {
        return self::$inputData["pwd"] !== self::$inputData["pwd_repeat"];
    }

}