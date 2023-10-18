<?php

class User {
    public int $id;
    public string $fname;
    public string $lname;
    public string $email;
    public string $password;
    public string $street;
    public string $zip;
    public string $city;
    public string $country;
    public ?string $payment_type;
    public string $iban;
}

class Product {
    public int $id;
    public string $name;
    public string $description;
    public float $price_per_minute;
}


class Contract {
    public int $id;
    public int $customer_id;
    public int $product_id;
    public string $status;
    public DateTime $start;
    public ?DateTime $end;
    public string $comment;
    public string $boat_registration_number;

    // DateTime muss manuell umgewandelt werden!
    public function __set($property, $value){
        // $property: Spaltenname in der DB
        if($property === 'start'){
            // DB: 2023-10-02 18:30
            // erzeuge DateTime-Objekt
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $value);
            // setze DateTime-Objekt als Eigenschaft im Objekt
            $this->start = $date; 
        } else if($property === 'end'){
            // END-Datum ist optional!
            if($value == NULL){
                $this->end = NULL; 
            } else {
                $date = DateTime::createFromFormat('Y-m-d H:i:s', $value);
                $this->end = $date; 
            }
        }
        else {
            // alle anderen Eigenschaften die genau so heißen wie in DB
            $this->$property = $value;
        }
    }
}

?>