<?php
declare(strict_types=1);

function is_input_empty(array $signupData, ?int $paymentMethod) : bool {
    $requiredFields = ["fname", "lname","email","pwd","street","city","country","zip"];
    
    
    foreach($requiredFields as $field){
        if( ! isset($signupData[$field]) || empty($signupData[$field])){
            return true;
        }
    }
    return false;
}