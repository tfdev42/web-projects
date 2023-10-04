<?php
require_once __DIR__ . '/../maininclude.inc.php';

// Lade Brands als Array
$brands = $dba->getBrands();


// Gebe es als JSON aus
echo json_encode($brands);


?>