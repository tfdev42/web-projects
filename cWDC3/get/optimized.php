<?php
    // show errors
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    function isPrime($n){
        if ($n <= 1) {            
            return false;
        }
        for ($i = 2; $i * $i <= $n; $i++) {
            if ($n % $i == 0) {
                return false;
            }
        }
        return true;
    }

    if(isset($_GET['number'])){
        $number = $_GET['number'];
        $result = null;
        if($number !== null) {
            if (is_numeric($number) 
            && $number > 0 
            && $number == round($number, 0)) {
                $result = isPrime($number);
            } else {
                echo "Please enter a valid positive integer.";
            }
        }
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
    <form action="optimized.php" method="get">
        <label for="number">Please enter a number.</label><br>
        <input type="text" name="number">    
        <input type="submit" value="Go!">
        <p>
        <?php
            if ($result !== null) {
                if ($result) {
                    echo "The number $number is prime.";
                } else {
                    echo "The number $number is not prime.";
                }
            }
        ?>
        </p>
        
    </form>
</body>
</html>
