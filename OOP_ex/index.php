<?php
declare(strict_types=1);
include "includes/class_autoloader.inc.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
</head>
<body>
    <main>
        <form action="includes/calc.inc.php" method="post">
            <p>Calculator</p>
            <input type="number" name="num1" placeholder="First number">
            <select name="oper">
                <option value="add">Addition</option>
                <option value="add">Substraction</option>
                <option value="add">Division</option>
                <option value="add">Multiplication</option>
            </select>
            <input type="number" name="num2" placeholder="Second number">
            <button type="submit" name="submit">Calculate</button>
        </form>
    </main>
</body>
</html>