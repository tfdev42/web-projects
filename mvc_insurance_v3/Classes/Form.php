<?php
declare(strict_types=1);

class Form{
    public $formData = [];
    public $errors = [];
    public $inputData = [];
    
    public function __construct($formData) {
        $this->formData = $formData;
    }

    public function validate() {
        foreach($this->formData as $key => $value){
            $value = $this->trimAndStrip($value);
            // check if input empty
            if(empty($value)){
                $this->errors[$key] = ucfirst($key) . " is required!";
            }            
        }
        return $this->errors;
    }

    function getInputData() : array {
        foreach($this->formData as $key => $value){
            $this->inputData[$key] = $value;
        }
        return $this->inputData;
    }

    function trimAndStrip(string $data){
        $data = trim($data);
        $data = stripslashes($data);
        return $data;
    }

}