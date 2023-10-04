<?php
require_once __DIR__ . '/../maininclude.inc.php';

$product = $dba->getProductById($_GET['id']);


// Gebe es als JSON aus
echo json_encode($product);


?>