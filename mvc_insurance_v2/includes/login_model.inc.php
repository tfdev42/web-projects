<?php

declare(strict_types=1);

function get_user(object $pdo, int $userId) : array | false {
    $query =
    "SELECT *
    FROM users
    WHERE id=:userId;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":userId", $userId);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}