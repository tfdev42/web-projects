<?php
declare(strict_types=1);

function is_input_empty(string $inputData){
    return empty($inputData);
}

function is_email_invalid(string $email){
    return ( ! filter_var($email, FILTER_VALIDATE_EMAIL));
}