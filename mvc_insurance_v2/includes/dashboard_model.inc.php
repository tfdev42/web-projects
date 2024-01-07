<?php
declare(strict_types=1);


function get_products(object $pdo) : array | false {
    $query =
    "SELECT *
    FROM product;";

    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}


function get_user_by_id(object $pdo, $userId) : array | false {
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