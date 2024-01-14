<?php

class Child extends Person {
    private $person;
    public string $name;
    public int $age;
    
    
    public static $ageLimit = 8;

    public function __construct() {
        $this->person = new Person($this->name, $this->age);
        
        
    }
}