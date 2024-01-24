<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once "./includes/autoload_classes.inc.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
</head>
<body>
    <?php
    $test = new Test();
    $test->getUsersDataWithTableNames();
    ?>
    <p>getUsers function <br>
        <?php
        $test->getUsers();
        ?>
    </p>
    <p>Set User <br>
        <?php
            $test->setUser("Pipi", "Langstrumpf", "2004-03-28");
        ?>
    </p>

    <p>Modify User <br>
        <?php
            $test->updateLastname("Pipi", "Langstrumpf-Testarosa");
        ?>
    </p>
</body>
</html>
