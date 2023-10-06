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
    public function __construct(
        int $productId,
        string $productName,
        string $productDescription,
        float $pricePerMinute
    ) {
        $this->productId = $productId;
        $this->productName = $productName;
        $this->productDescription = $productDescription;
        $this->pricePerMinute = $pricePerMinute;
    }
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
    public function __construct(
        int $insureId,
        int $customerId,
        int $productId,
        string $status,
        DateTime $startTime,
        DateTime $endTime,
        ?string $comment,
        string $licensePlate
    ) {
        $this->insureId = $insureId;
        $this->customerId = $customerId;
        $this->productId = $productId;
        $this->status = $status;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->comment = $comment;
        $this->licensePlate = $licensePlate;
    }
}


?>