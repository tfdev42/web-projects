<title>Operatoren</title>

<?php

// Enable WARNINGS ON LINUX >>>>>>
error_reporting(E_ALL);

ini_set('display_errors','1');

// echo phpinfo();

/**
 * Operatoren
 * - Arithmetischen Operatoren --> + - * / % (Rechenoperatoren)
 * - Zuweisungsoperator --> = (weist einer Variable einen Wert zu)
 * - Vergleichsoperatoren --> boolean --> ==, >=, <=, != >> immer boolean Wert: true / false
 */

$a = 5;
$b = 10;
$a = $b;
echo $a == $b;

// Arithmetischen Operatoren
$a = 5;
$b = 10;
$c = $a + $b;

echo '<p>Ergebnis von $a + $b:</p>';
echo $c;

// Modulo %

$vname = 'Tamas';
$nname = 'Fazekas';
$vollerName = $vname.' '.$nname; // strings werden mit '.' addiert
echo '<p>Der volle Name ist:</p>';
echo $vollerName;


echo '<br>';
$x = '5b';
$y= '10';
echo $x + $y; //WARNING weil $x = 5b > wird als STR concatiniert
echo '<br>';
echo $x.$y;


/**
 * Vergleichoperatoren
 * häufig bei Kontrollstrukturen: if, while, for
 * Kontrollstruktur steuert welcher Code ausgeführt wird
 */

$alter = 16;
if($alter >= 18){
    echo '<br>';
    echo 'OK';
}else{
    echo '<br>';
    echo 'NOK';
}




?>