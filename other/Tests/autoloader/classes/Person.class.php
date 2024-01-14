<?php

class Person {
    private string $name;
    private int $age;

    public static $ageLimit = 18;

    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;

    }

    public function walk() 
    {
        return $this->name . " walks.";
    }

    public function getAge() 
    {
        return $this->name . " is " . $this->age . " old,";
    }

    private function setAge(int $newAge)
    {
        $this->age = $newAge;
    }

    public function getName() 
    {
        return $this->name;
    }

    public static function getStaticProperty() {
        return self::$ageLimit;
    }
}