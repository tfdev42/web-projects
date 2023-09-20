<?php

class Brand {
    public int $id;
    public string $name;
    public function __construct($id, $name){
        $this->id = $id;
        $this->name = $name;
    }
}

class User {
    public int $id;
    public string $fname;
    public string $lname;
    public string $email;
    public string $password;
    public bool $is_admin;
}

class Category {
    public int $id;
    public string $name;
}

class Product {
    public int $id;
    public string $sku;
    public int $brand_id;
    // ?int: int oder NULL fuer optionale werte
    public ?int $category_id;
    public string $name;
    public string $description;
    public string $picture;
    public float $price;
    public int $stock;
    public bool $is_removed;
}

?>