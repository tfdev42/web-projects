<?php
    // show errors
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    if(is_numeric($_GET['number'])
    && $_GET['number'] > 0
    && $_GET['number'] == round($_GET['number'], 0)){
        $theNumber = $_GET['number'];
        $i = 2;
        $isPrime = true;

        while($i < $theNumber){
            if($theNumber % $i == 0){
                $isPrime = false;
            }
            $i++;
        }

        if($isPrime){
            echo '<p>' . $theNumber . ' is a prime number.</p>';
        } else {
            echo '<p>' . $theNumber . ' is NOT a prime number.</p>';
        }
    } elseif($_GET){
        echo "<p>Please enter a positive shole number.</p>";
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GET</title>
</head>
<body>
    <p>Please enter a number.</p>
    <form action="index.php" method="get">
        <input type="text" name="number">    
        <input type="submit" value="Go!">
    </form>
</body>
</html>