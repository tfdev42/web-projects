<?php
declare(strict_types=1);


function set_user(object $pdo, array $signupData){

    // comma seperated list of clumn names
    $columns = implode(", ", array_keys($signupData));

    // values
    $placeholders = ":" . implode(", :", array_keys($signupData));

    $query = "INSERT INTO users ($columns) VALUES ($placeholders)";

    $stmt = $pdo->prepare($query);

    // $hashedPwd = password_hash($signupData["pwd"], PASSWORD_DEFAULT);

    foreach ($signupData as $key => $value) {
        // if $key === "pwd" $value = $hashedPwd else...
        $stmt->bindValue(":$key", $value);
    }
    $stmt->execute();

}