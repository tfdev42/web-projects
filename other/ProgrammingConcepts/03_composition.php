<?php
class Engine {
    public function start() {
        echo "Engine started\n";
    }
}

class Car {
    public $engine;

    public function __construct() {
        // Composition
        $this->engine = new Engine();
    }

    public function start() {
        $this->engine->start();
    }
}

$myCar = new Car();
$myCar->start();
?>
