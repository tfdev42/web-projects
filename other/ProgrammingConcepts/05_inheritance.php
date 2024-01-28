<?php
class Animal {
    public function speak() {
        // abstract Method
    }
}

class Dog extends Animal {
    public function speak() {
        return "Woof!";
    }
}

class Cat extends Animal {
    public function speak() {
        return "Meow!";
    }
}

$myDog = new Dog();
$myCat = new Cat();
echo $myDog->speak() . "\n";
echo $myCat->speak() . "\n";
?>
