<?php
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', '1');
// require_once "./class_autoloader.inc.php";

$operator = $_POST["operator"];
$num1 = $_POST["num1"];
$num2 = $_POST["num2"];

$calc = new Calc($operator, (int)$num1, (int)$num2);

try {
    echo $calc->calculator();
} catch (TypeError $e) {
    echo "Error: " . $e->getMessage();
}


