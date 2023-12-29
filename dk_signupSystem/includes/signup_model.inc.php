<?php

// 'MODEL' IS ONLY FOR INTERACTING WITH THE DATABASE
// SENSITIVE FUNCTIONS!

// WE ARE ALLOWING OUR CODE TO HAVE TYPE DECLARATIONS
// The primary purpose of type declarations is to enhance code clarity, catch errors early, and improve maintainability.

declare(strict_types=1);
// THIS GOES INTO CONTR AND VIEW TOO!


// dbh is required in signup.inc.php
function get_username(object $pdo, string $username) {
    $query =
    "SELECT username
    FROM users
    WHERE username = :username;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    //check whether we get a row of data, if yes, take the first found row
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}


function get_email(object $pdo, string $email) {
    $query =
    "SELECT email
    FROM users
    WHERE email = :email;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_user(object $pdo, string $username,string $pwd,string $email) {
    $query =
    "INSERT INTO users (username, pwd, email)
    VALUES (:username, :pwd, :email);";

    // prevent bruteforcing by increasing the Hash-Cost, or use PASSWORD_DEFAULT without Options
    $options = [
        'cost' => 12
    ];
    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":pwd", $hashedPwd);
    $stmt->bindParam(":email", $email);
    $stmt->execute();


}