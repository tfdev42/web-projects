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

    // Prueft ob das Produkt verfugbar ist / sonst false
    
    public function isAvailable() : bool {
        if($this->stock <=0 || $this -> is_removed){
            return false;
        }
        return true;
    }
}


class Orders{
    public int $id;
    public int $user_id;
    public DateTime $orderDate;
    public string $zip;
    public string $country;
    public string $address;
    public float $total;

    // DateTime muss manuell umgewandelt weden!
    public function __set($property, $value){
        // $property: Spaltenname in der DB
        if($property === 'order_date'){
            // DB: 2023-10-02 18:30
            $date = DateTime :: createFromFormat('Y-m-d H:i:s', $value);
            // setze DateTime_Objekt als eigenschaft im Objekt
            $this->orderDate = $date;
        } else {
            // alle anderen Eigenschaften die genau so heissen wie in der DB
            $this->$property = $value;
        }
    }
}


class OrderPosition{
    public int $id;
    public int $product_id;
    public int $order_id;
    public int $stock;
    public float $unit_price;
}

?>