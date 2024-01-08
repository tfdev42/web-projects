<?php
declare(strict_types=1);

function remove_product(object $pdo, int $productId) {
    $query =
    "DELETE FROM product WHERE id = :id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(":id", $productId, PDO::PARAM_INT);
    $stmt->execute();
}

function set_product(object $pdo, string $name, string $description, string $ppm) {
    $query =
    "INSERT INTO product (name, description, price_per_minute)
    VALUES (:name, :description, :ppm);";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(":name", $name);
    $stmt->bindValue(":description", $description);
    $stmt->bindValue(":ppm", $ppm);
    $stmt->execute();
}