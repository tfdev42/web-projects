<?php

    error_reporting(E_ALL);

    ini_set('display_errors','1');

    // Alle Zahlen von 1-10 ausgeben
    $zahl = 1;
    
    while($zahl <= 10){
        echo "<p>$zahl</p>";
        $zahl++;
    }


    // for-Schleife
    echo '<h2>for-Schleife:</h2>';

    for($zahl = 1; $zahl <= 10; $zahl++){
        echo "<p>$zahl</p>";
    }
    // $zahl = 11


    // Endlosschleife
    while(true){
        // Arbitrary calculations
        break;
    }


    // continue --> bricht den Aktuellen durchgang des Loops ab und setzt mit dem naechsten
    // Teil des loops fort

    echo '<h2>continue / break:</h2>';
    for ($i = 20; $i <= 30; $i++){
        // ueberspringe gerade zahlen
        if ($i % 2 == 0){
            continue;
        }
        echo "<p>$i ist eine Ungerade Zahl.</p>";
    }

?>