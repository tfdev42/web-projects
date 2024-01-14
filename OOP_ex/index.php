<?php
declare(strict_types=1);
include "includes/class_autoloader.inc.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
</head>
<body>
    <main>
        <form action="index.php" method="post">
            <p>Calculator</p>
            <input type="number" name="num1" placeholder="First number">
            <select name="operator">
                <option value="add">Addition</option>
                <option value="sub">Substraction</option>
                <option value="div">Division</option>
                <option value="mul">Multiplication</option>
            </select>
            <input type="number" name="num2" placeholder="Second number">
            <button type="submit" name="submit">Calculate</button>
        </form>
        <?php if (isset($_POST["submit"])){
            echo '<section>Result: ';
            include "./includes/calc.inc.php";
            echo '</section>';
        } ?>
        
    </main>
</body>
</html>