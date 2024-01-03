<?php
declare(strict_types=1);


// function get_role_id_from_signup() {

//     if($_SESSION["role_signup"] === "customer"){
//         return 3;
//     }
    
//     if($_SESSION["role_signup"] === "manager"){
//         return 1;
//     }

//     if($_SESSION["role_signup"] === "agent"){
//         return 2;
//     }    
// }


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