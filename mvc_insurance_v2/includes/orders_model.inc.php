<?php
declare(strict_types=1);

function order_product(object $pdo, string $customerId, string $productId, string $boat_registration_number) {
    $query=
    "INSERT INTO orders (customer_id, product_id, boat_registration_number)
    VALUES (:customer_id, :product_id, :brn)";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(":customer_id", $customerId, PDO::PARAM_INT);
    $stmt->bindValue(":product_id", $productId, PDO::PARAM_INT);
    $stmt->bindValue(":brn", $boat_registration_number);
    $stmt->execute();
}