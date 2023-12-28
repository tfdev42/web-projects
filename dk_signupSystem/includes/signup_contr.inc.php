<?php

declare(strict_types=1);

function is_input_empty(string $username,string $pwd,string $email) : bool{
    if (empty($username) || empty($pwd) || empty($email)) {
        return true;
    }
    else {
        return false;
    }
}

function is_email_invalid(string $email) : bool{
    if ( ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    else {
        return false;
    }
}

// ONLY MODEL FILE IS ALLOWED TO QUERY DB
function is_username_taken(object $pdo, string $username) : bool{
    if (get_username($pdo, $username)) {
        return true;
    }
    else {
        return false;
    }
}

function is_email_registered(object $pdo, string $email) : bool{
    if (get_email($pdo, $email)) {
        return true;
    }
    else {
        return false;
    }
}