<?php
declare(strict_types=1);



function is_email_taken(object $pdo, string $email) : bool {
    if(get_email($pdo, $email)){
        return true;
    }
    else {
        return false;
    }
}



function unset_signup_form(){
    unset($_SESSION["role_signup"]);
    unset($_SESSION["signup_data"]);
    exit();
}


function create_user(object $pdo, array $signupData){
    set_user($pdo, $signupData);
}

function switch_role_Str_to_ID(array &$signupData) {
    switch ($signupData["role_id"]) {
        case "manager":
            $signupData["role_id"] = 1;
            break;
        case "agent":
            $signupData["role_id"] = 2;
            break;
        case "customer":
            $signupData["role_id"] = 3;
            break;
        
        default:
            
            break;
    }
    // $_SESSION["test_value"] = $signupData["role_id"];
}


function switch_role_ID_to_Str(array &$signupData) {
    switch ($signupData["role_id"]) {
        case "1":
            $signupData["role_id"] = "manager";
            break;
        case "2":
            $signupData["role_id"] = "agent";
            break;
        case "3":
            $signupData["role_id"] = "customer";
            break;
        
        default:            
            break;
    }
}


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