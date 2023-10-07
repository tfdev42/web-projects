<?php

class FormValidator {
    private string $fname=$lname=$email=$password=$street=$city=$country=$zip='';
    private string $fnameErr=$lnameErr=$emailErr=$passwordErr=$streetErr=$cityErr=$countryErr=$zipErr='';
    
    // $paymentMethod -- other way
    private $errors;

    public function __construct(&$errors) {
        $this->errors = &$errors;
    }

    public function validate(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(empty($_POST['fname'])){
                $this->fnameErr = "First name is required";
            } else $this->fname = self::test_input($_POST['fname']);
    
            if(empty($_POST['lanme'])){
                $this->lnameErr = "Last name is required";
            } else $this->lname = self::test_input($_POST['lname']);
    
            if(empty($_POST['email'])){
                $this->emailErr = "Email is required";
            } else $this->email = self::test_input($_POST['email']);
    
            if(empty($_POST['password'])){
                $this->passwordErr = "Password is required";
            } else $this->password = self::test_input($_POST['password']);
    
            if(empty($_POST['street'])){
                $this->streetErr = "Street name is required";
            } else $this->street = self::test_input($_POST['street']);
    
            if(empty($_POST['city'])){
                $cityErr = "City name is required";
            } else $city = self::test_input($_POST['city']);
    
            if(empty($_POST['country'])){
                $countryErr = "Country name is required";
            } else $country = self::test_input($_POST['country']);
    
            if(empty($_POST['zip'])){
                $zipErr = "Zip name is required";
            } else $zip = self::test_input($_POST['zip']);
        }
    }
    


    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}


?>