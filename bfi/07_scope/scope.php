<?php
    include 'function.php'; // ../ parent folder (punkt-punkt-slash)

    // WARNINGS
        // Enable WARNINGS ON LINUX >>>>>>
        error_reporting(E_ALL);

        ini_set('display_errors','1');
        // >>>>>>>>>>>>
    
    $a = 7;

    {
        echo "<p>a im Block: $a</p>";

        // definiere innerhalb des Blocks $b
        $b = 10;
    }

    echo '<p>$a</p>';
    echo "<p>B ausserhalb des Blocks: $b</p>";


?>