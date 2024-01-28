<?php
class Employee {
    public $name;

    public function __construct($name) {
        $this->name = $name;
    }
}

class Department {
    public $name;
    public $employees;

    public function __construct($name) {
        $this->name = $name;
        $this->employees = [];
    }
}



$department1 = new Department("HR");
$employee1 = new Employee("Bob");

// The Aggregative part
$department1->employees[] = $employee1;
?>
