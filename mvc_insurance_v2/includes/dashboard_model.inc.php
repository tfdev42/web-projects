<?php
declare(strict_types=1);

function get_agent_orders(object $pdo){
    $query= 
    "SELECT o.id AS 'OrderID', o.customer_id AS 'CustomerID', p.name AS 'Product', o.boat_registration_number AS 'Registration', o.status_name AS 'Status', o.comment AS 'Comment'
    FROM orders AS o 
    JOIN product AS p ON p.id = o.product_id;";
    $stmt=$pdo->prepare($query);    
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function get_customer_orders(object $pdo, int $customerId){
    $query= 
    "SELECT o.id AS 'OrderID', p.name AS 'Product', o.boat_registration_number AS 'Registration', o.status_name AS 'Status'
    FROM orders AS o 
    JOIN product AS p ON p.id = o.product_id
    WHERE customer_id = :customer_id;";
    $stmt=$pdo->prepare($query);
    $stmt->bindValue(":customer_id", $customerId);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}


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