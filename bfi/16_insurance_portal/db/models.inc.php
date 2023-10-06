<?php
class User {
    public int $userId;
    public string $fname;
    public string $lname;
    public string $email;
    public string $password;
    public string $street;
    public string $city;
    public string $country;
    public string $zip;
    public string $paymentMethod;
    public bool $is_admin = false;
    public function __construct(
        int $userId,
        string $fname,
        string $lname,
        string $email,
        string $password,
        string $street,
        string $city,
        string $country,
        string $zip,
        string $paymentMethod,
        bool $is_admin = false
    ) {
        $this->userId = $userId;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->password = $password;
        $this->street = $street;
        $this->city = $city;
        $this->country = $country;
        $this->zip = $zip;
        $this->paymentMethod = $paymentMethod;
        $this->is_admin = $is_admin;
    }
}


class Product {
    public int $productId;
    public string $productName;
    public string $productDescription;
    public float $pricePerMinute;
}

class Insurance {
    public int $insureId;
    public int $customerId;
    public int $productId;
    public string $status;
    public DateTime $startTime;
    public DateTime $endTime;
    public ?string $comment;
    public string $licensePlate;
}


?>