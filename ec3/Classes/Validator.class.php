<?php

class Validator {
    public $postArray;


    /**
     * get $_POST array and trim values
     */
    public function __construct() {
        $this->postArray = [];
        $this->getPostInputs();
    }

    public function getPostInputs(){
        foreach($_POST as $key => $value){
            if ($key == 'bt_signup' || $key = 'bt_login') continue;
            $this->postArray[$key] = trim($value);
        }
    }

    public function getTrimmedPostArray(){
        return $this->postArray;
    }

    /**
     * TRUE if any input is empty
     */
    public function isInputEmpty() {
        foreach ($this->postArray as $value){
            if (empty($value)) return true;
        }
    }

    public function isEmailInvalid() {
        return filter_var($this->postArray["email"], FILTER_VALIDATE_EMAIL) === "false";
    }
}