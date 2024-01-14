<?php

class Child extends Person {
    private $person;
    public string $name;
    public int $age;
    
    
    public static $ageLimit = 8;

    public function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;

        
        
    }
}