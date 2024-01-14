<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include "./includes/class_autoload.inc.php";
// include "./classes/person.class.php";
// include "./classes/child.class.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autolaoder Test</title>
</head>
<body>
    <h3>Testingfield</h3>
    <p>
        <?php
        $person1 = new Person("Peter", 24);
        var_dump($person1);
        echo $person1->walk();
        echo Person::getStaticProperty();
        echo '<br>';

        $child1 = new Child("Miky", 1);
        echo $child1->walk();
        var_dump($child1);

        echo "<br>";



        ?>
    </p>
</body>
</html>