<?php
class Shape {
    public function area() {
        // abstract Method
    }
}

class Circle extends Shape {
    public $radius;

    public function __construct($radius) {
        $this->radius = $radius;
    }

    public function area() {
        return 3.14 * $this->radius ** 2;
    }
}

class Square extends Shape {
    public $side;

    public function __construct($side) {
        $this->side = $side;
    }

    public function area() {
        return $this->side ** 2;
    }
}

$myCircle = new Circle(5);
$mySquare = new Square(4);
echo $myCircle->area() . "\n";
echo $mySquare->area() . "\n";
?>
