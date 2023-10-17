<?php

    $fname=$lname=$email=$password=$street=$city=$country=$zip=
    $fnameErr=$lnameErr=$emailErr=$passwordErr=$streetErr=$cityErr=$countryErr=$zipErr="";

    // $paymentMethod
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(empty($_POST['fname'])){
            $errors['fnameErr'] = "First name is required";
        } else $fname = test_input($_POST['fname']);

        if(empty($_POST['lname'])){
            $errors['lnameErr'] = "Last name is required";
        } else $lname = test_input($_POST['lname']);

        if(empty($_POST['email'])){
            $errors['emailErr'] = "Email is required";
        } else $email = test_input($_POST['email']);

        if(empty($_POST['password'])){
            $errors['passwordErr'] = "Password is required";
        } else $password = test_input($_POST['password']);

        if(empty($_POST['street'])){
            $errors['streetErr'] = "Street name is required";
        } else $street = test_input($_POST['street']);

        if(empty($_POST['city'])){
            $errors['cityErr'] = "City is required";
        } else $city = test_input($_POST['city']);

        if(empty($_POST['country'])){
            $errors['countryErr'] = "Country is required";
        } else $country = test_input($_POST['country']);

        if(empty($_POST['zip'])){
            $errors['zipErr'] = "Zip is required";
        } else $zip = test_input($_POST['zip']);
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }




?>