<?php

class Sanitize {

    protected $postArray;
    protected $errors = [];
    

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
    public function setTrimmedPostArray() {        
        $this->postArray = $_POST;
        /**
         * the '&' is IMPORTANT in '&$value'
         */
        foreach ($this->postArray as $key => &$value){
            $this->postArray[$key] = trim($value);
        }
    }


    public function sanitize() {    
        
        foreach ($this->postArray as $key => &$value) {

            
            if (empty($value)) {
                $this->errors[] = "Fill in all fields!";
                break;
            }

            switch ($key){
                
                case "user_name":
                    if (ctype_alnum($value) === false) {
                        $this->errors[] = "Username must be a combination of letters and numbers.";
                    }
                    if (strlen($value) < 5 || strlen($value) > 15) {
                        $this->errors[] = "Username must be between 5 - 15 characters.";
                    }
                    break;

                case "password":
                    $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[:#?!@$%^&*-])[A-Za-z\d@$!^%*:#?&]{8,}$/";
                    if (preg_match($pattern, $value) === 0) {
                        $this->errors[] = "Password Min. lenght: 8. 1 Upper, 1 Lower, 1 Number, 1 Special Char!";
                    }                    
                    break;

                case "password_repeat":
                    if ($value !== $this->postArray["password"]){
                        $this->errors[] = "Passwords don't match.";
                    }
                    break;

                case "email":
                    $value = filter_var($value, FILTER_SANITIZE_EMAIL);          
                    if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
                        $this->errors[] = "Enter a valid email address.";
                    }        
                    break;

                default:                    
                    break;

                
            }
        }
    }


}