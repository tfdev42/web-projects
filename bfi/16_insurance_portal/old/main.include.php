<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();
include 'header.php';
// DB Access
require_once 'db/dbaccess.inc.php';
$dba = new DbAccess();

$errors = [];
$user = $_SESSION['user_id'];
// if($_SESSION['userId']){    
//     $user = $_SESSION['user'];
// }




?>