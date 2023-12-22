<?php
// show errors in linux
error_reporting(E_ALL);
ini_set('display_errors', '1');

// always start session
session_start();

$errors = [];

require_once "./db.access.php";
$dba = new DBAccess();

$userId;