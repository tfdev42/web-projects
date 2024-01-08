<?php
declare(strict_types=1);

function order_product(object $pdo, string $customerId, string $productId) {
    $query=
    "INSERT INTO orders (customer_id, product_id)
    VALUES (:customer_id, :product_id)";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(":customer_id", $customerId, PDO::PARAM_INT);
    $stmt->bindValue(":product_id", $productId, PDO::PARAM_INT);
    $stmt->execute();
}