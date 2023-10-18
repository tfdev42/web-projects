<?php

// Fehlermeldungen einschalten
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Session erstellen
session_start();

// Warenkorb erstellen falls noch nicht existiert
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

require_once 'db/dbaccess.inc.php';
// Objekt der Klasse DbAccess erzeugen 
$dba = new DbAccess();

$errors = [];

// aktuell angemeldeten User laden
// $user ist FALSE wenn nicht angemeldet
$user = $dba->getCurrentUser();

?>