<?php

class Validate {

    protected $postArray;

    /**
     * FILTER Arguments
     */
    protected $args = array(
        "user_pwd" => array(
            'filter' => FILTER_CALLBACK,
            'options' => array('options' => 'validatePassword'),
        ),
        "user_name" => array(
            'filter' => FILTER_CALLBACK,
            'options' => array('options' => 'validateUsername'),
        ),
        // Add more fields as needed
    );

    public function __construct() {
        $this->postArray;
    }

    public function getPostArray() {
        return $this->postArray;
    }

    public function setPostArray() {
        
        $this->postArray = $_POST;

        foreach ($this->postArray as &$value) {
            $value = trim($value);
        }
        
    }

    public function validate() {
        return filter_var_array($this->postArray, $this->args);
    }

    function validateUsername($username) {
        // Example: Username should be alphanumeric and have a minimum length of 5 characters
        return (ctype_alnum($username) && strlen($username) >= 5) ? $username : false;
    }
}