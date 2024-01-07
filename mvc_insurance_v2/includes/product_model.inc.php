<?php
declare(strict_types=1);

function set_product(object $pdo, string $name, string $description, float $ppm) {
    $query =
    "INSERT INTO product (name, description, price_per_minute)
    VALUES (:name, :description, :ppm);";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(":name", $name);
    $stmt->bindValue(":description", $description);
    $stmt->bindValue(":ppm", $ppm);
    $stmt->execute();
}