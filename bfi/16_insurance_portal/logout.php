<?php
require_once 'main.include.php';
session_unset();
session_write_close();
$url = "./index.php";
header("Location: $url");
?>