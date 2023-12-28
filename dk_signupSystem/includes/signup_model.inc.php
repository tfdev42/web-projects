<?php

// 'MODEL' IS ONLY FOR INTERACTING WITH THE DATABASE
// SENSITIVE FUNCTIONS!

// WE ARE ALLOWING OUR CODE TO HAVE TYPE DECLARATIONS
// The primary purpose of type declarations is to enhance code clarity, catch errors early, and improve maintainability.

declare(strict_types=1);
// THIS GOES INTO CONTR AND VIEW TOO!


// dbh is required in signup.inc.php
function get_username(object $pdo, string $username) : object|false{
    $query =
    "SELECT username
    FROM users
    WHERE username = :username;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    //check whether we get a row of data
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}


function get_email(object $pdo, string $email) : object|false{
    $query =
    "SELECT email
    FROM users
    WHERE email = :email;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    //check whether we get a row of data
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}