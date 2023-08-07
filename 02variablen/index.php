<?php

// vaiablen
$vorname = 'Marc'; // Datentyp String ''
$nachname = "Fenz";
$alter = 30; // INT
$gehalt = 1234.56; // float, immer "Punkt"
$verheiratet = false; // boolean (true / false)

/**
 * Namenskonventionen:
 * - Keine Umlaute
 * 
 * Variablenamen beginnen immer mit einem Kelinbuchstaben
 * Variablenamen müssen mit einem Buchstaben starten
 * 
 * Besteht ein Variablename aus mehreren zusammengesetzten Namen:
 * - $anzahl_schueler = 5;
 * - $anzahlSchueler = 5;
 * >> camel case besser
 */

echo $vorname;
echo '<br>';
echo $nachname;

/**
 * einer bestehenden Variable einen neuen Wert zuweisen
 */

$nachname = 'Huber';
echo '<br>';
echo $nachname;

?>