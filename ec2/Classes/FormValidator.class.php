<?php

class FormValidator {

    private static $inputData = [];

    public static function setInputDataArray($postArray){
        self::$inputData = $postArray;
    }

    public static function unsetInputDataArray(){
        self::$inputData = null;
    }

    public static function getInputDataArray(){
        return self::$inputData;
    }

    public static function trimInputDataArray() {
        $fields = self::$inputData;
        foreach ($fields as $key => $value){
            self::$inputData["$key"] = trim($value);
        }
    }

    /**
     * returns TRUE if any input field left empty
     */
    public static function isAnyInputEmpty() {
        foreach (self::$inputData as $value) {
            if (empty($value)) {
                return true;
            }
        }
        return false;
    }    

    /**
     * single field inputEmpty Test returns TRUE if $inputField is empty
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
        return strlen(self::$inputData["pwd"]) < 13;
    }

    /**
     * returns TRUE if pwd doesn't contain special chars
     */
    public static function pwdDoesntContainSpecialChars(){

        $pattern = '/[!@#$%^&*()_+{}\[\]:;<>,.?~\\\-]/';

        return preg_match($pattern, self::$inputData["pwd"]) === 0;
    }

    /**
     * returns TRUE if pwd doesn't contain 1 capital letter
     */
    public static function pwdDoesntContainCapitalLetter(){

        $pattern = '/[A-Z]/';

        return preg_match($pattern, self::$inputData["pwd"]) === 0;
    }

    /**
     * returns TRUE if pwd doesn't contain 1 number
     */
    public static function pwdDoesntContainNumber(){

        $pattern = '/[0-9]/';

        return preg_match($pattern, self::$inputData["pwd"]) === 0;
    }

    /**
     * returns TRUE if Pwd !== Repeat Pwd
     */
    public static function pwdDoesntMatchRepeatPwd() {
        return self::$inputData["pwd"] !== self::$inputData["pwd_repeat"];
    }

}