<?php
function fibonacci($n) {
    $fibonacciSequence = [];
    for ($i = 0; $i < $n; $i++) {
        if ($i <= 1) {
            $fibonacciSequence[] = $i;
        } else {
            $fibonacciSequence[] = $fibonacciSequence[$i - 1] + $fibonacciSequence[$i - 2];
        }
    }
    return $fibonacciSequence;
}

// Example usage
$count = 10; // Replace with the desired count of Fibonacci numbers
$fibonacciNumbers = fibonacci($count);
echo "Fibonacci Sequence: " . implode(", ", $fibonacciNumbers);
?>
