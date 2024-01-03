<?php
declare(strict_types=1);


function is_input_empty(array $signupData){

    foreach($signupData as $key=>$value){
        if( ! isset($value) || empty($value)){
            return true;
        }
    }
    return false;
}


function is_email_invalid(string $email){
    return ( ! filter_var($email, FILTER_VALIDATE_EMAIL));
}