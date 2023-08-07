<?php

    // WARNINGS
    // Enable WARNINGS ON LINUX >>>>>>
    error_reporting(E_ALL);

    ini_set('display_errors','1');
    // >>>>>>>>>>>>

    $a = 'Servus!';

    // Functions haben einen eigenen Scope
    // aussrehalb deklarierte Variablen sind innerhhalb der function nicht sichtbar
    function hello(){
        echo $a;
    }

    function works(){
        $a = 10;
        echo "<p>Ausgabe von A innerhalb der Funktion: $a</p>";
    }

    // Functions muessen aufgerufen werden
    // Functions immer einfach mit dem Function-Name und () aufrufen
    works();
    echo "<p>Ausgabe von A ausserhalb der Funktionen: $a</p>";
    hello();
    


?>