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
            
            // check if Email Valid
            if($key === '/^email*/' && $this->isEmailInvalid($key)){
                $this->errors[$key] = "A valid ". $key . " is required!";                
            }

            
        }
        return $this->errors;
    }


    // for re-inserting input values into form if error
    function getInputData() : array {
        foreach($this->formData as $key => $value){
            // exclude password fields
            if ($key === '/^pwd*/' || $key === '/^password*/'){
                continue;
            } else {
                $this->inputData[$key] = htmlspecialchars($this->trimAndStrip($value));
            }
            
        }
        return $this->inputData;
    }

    function isEmailInvalid(string $key) : bool {
        // Returns True if email is Invalid
        return ! filter_var($key, FILTER_VALIDATE_EMAIL);
    }

    function trimAndStrip(string $data){
        $data = trim($data);
        $data = stripslashes($data);
        return $data;
    }

}