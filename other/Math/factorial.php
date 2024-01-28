<?php
function factorial($n) {
    if ($n == 0 || $n == 1) {
        return 1;
    } else {
        return $n * factorial($n - 1);
    }
}

// Example usage
$number = 5; // Replace with the desired number
$result = factorial($number);
echo "Factorial of $number is: $result";
?>
