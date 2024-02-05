<?php

class Validate {

    protected $postArray;
    protected $errors = [];

    /**
     * FILTER Arguments
     */
    protected $args = array(
        "user_pwd" => array(
            'filter' => FILTER_CALLBACK, 'options' => array('options' => 'validatePassword'),
        ),
        "user_name" => array(
            'filter' => FILTER_CALLBACK, 'options' => array('options' => 'validateUserName'),
        ),
        // Add more fields as needed
    );

    /**
     * Constructor
     */
    public function __construct() {
        $this->postArray;
        $this->errors;
    }

    /**
     * Getters
     */
    public function getPostArray() {
        return $this->postArray;
    }

    public function getErrors() {
        return $this->errors;
    }

    /**
     * Setters
     */
    public function setPostArray() {
        
        $this->postArray = $_POST;
        /**
         * the '&' is IMPORTANT in '&value'
         */
        foreach ($this->postArray as &$value) {
            $value = trim($value);
        }
        
    }

    public function validate() {
        return filter_var_array($this->postArray, $this->args);
    }

    /**
     * userName should be alphanumeric and have a minimum length of 5 characters
     */
    function validateUserName($userName) {        
        if (ctype_alnum($userName) === false
            // because VARCHAR(15) in the DB
            || strlen($userName) < 5 || strlen($userName) > 15) {

                }
    }

    /**
     * Minimum length of 8 characters
     * At least one uppercase letter, one lowercase letter,
     * one number, and one special character
     * Nobody remembers this regex pattern, you just 'copy-pasta' every time:
     * $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
     */
    function validatePassword($pwd) {        
        $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
    
        return (preg_match($pattern, $pwd)) ? $pwd : false;
    }
}