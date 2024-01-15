<?php

// Regular Class
include_once "classes/simpleclass.class.php";

$obj = new SimpleClass();
$obj->helloWorld();
echo '<br>';

// Anonymous Class

$newObj = new class(){
    public function helloWorld() {
        echo "Hello World from Anon Class";
    }
};

$newObj->helloWorld();