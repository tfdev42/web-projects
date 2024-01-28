<?php
class Person {
    public $name;

    public function __construct($name) {
        $this->name = $name;
    }
}

class Company {
    public $name;
    public $employees;

    public function __construct($name) {
        $this->name = $name;
        $this->employees = [];
    }

    public function hireEmployee($person) {
        $this->employees[] = $person;
    }
}

$person1 = new Person("Alice");
$company1 = new Company("XYZ Corp");

// The Associative Part
$company1->hireEmployee($person1);
?>
