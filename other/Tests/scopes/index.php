<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// '::' is the Scope Resolution Operator

class FirstClass {

    const EXAMPLE = "You can't change this!";

    public static function test() {
        $testing = "This is a test!";
        return $testing;
    }
}

class SecondClass extends FirstClass {

    public static $staticProperty = "A static property!";

    public static function anotherTest() {
        echo parent::EXAMPLE;
        echo self::$staticProperty;
    }
}

$a = FirstClass::EXAMPLE;
echo $a;
echo '<br>';

$b = SecondClass::anotherTest();
echo $b;